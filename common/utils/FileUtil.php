<?php

namespace common\utils;


use yii\helpers\FileHelper;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;
use Yii;

class FileUtil
{
    /**
     * @brief 上传文件
     * @param string $field 表单input域名称
     * @param string $target 目标目录
     * @param array $allowType 允许上传类型 e.g. ['jpg','png','gif']
     * @param bool $checkMimeType
     * @return string
     * @since 2016-08-02
     */
    public static function upload($field, $target = '', $allowType = [], $checkMimeType = false)
    {
        $target or $target = 'uploads/tempFile/';
        if (!FileHelper::createDirectory($target, 0777)) {
            YII_DEBUG and VarDumper::dump('上传目录生成失败');
            return '';
        }

        $allowType or $allowType = array_keys(Yii::$app->params['fileExt']);
        $allowType = array_map('strtolower', $allowType);

        $upload = UploadedFile::getInstanceByName($field);
        if (!$upload) {
            return '';
        }

        if (!self::validateUpload($upload, $allowType, $checkMimeType)) {
            return '';
        }

        $name = $upload->name;
        $savePath = StringUtil::transCoding($target.$name, 'UTF-8','GBK'); //防止中文名乱码
        if ($upload->saveAs($savePath)) {
            return StringUtil::transCoding($savePath, 'GBK', 'UTF-8'); //返回的是utf8编码，避免写入数据库时乱码
        }

        return '';
    }

    /**
     * @brief 检测上传文件类型
     * @param UploadedFile $file
     * @param array $allowType 允许上传类型 e.g. ['jpg','png','gif']
     * @param bool $checkMimeType
     * @return bool
     * @throws \yii\base\InvalidConfigException
     * @since 2016-08-02
     */
    public static function checkUploadFileExt(UploadedFile $file, array $allowType, $checkMimeType = false)
    {
        $extension = mb_strtolower($file->extension, 'utf-8');

        // check file by mimeType
        if ($checkMimeType && extension_loaded('fileinfo')) {
            $mimeType = FileHelper::getMimeType($file->tempName, null, false);
            if ($mimeType === null) {
                YII_DEBUG and VarDumper::dump('file mimeType is null: ' . $file->name);
                return false;
            }

            $extensionsByMimeType = FileHelper::getExtensionsByMimeType($mimeType);
            if (!in_array($extension, $extensionsByMimeType, true)) {
                YII_DEBUG and VarDumper::dump('file MimeType is error: ' . $file->name);
                return false;
            }
        }

        if (!in_array($extension, $allowType, true)) {
            YII_DEBUG and VarDumper::dump('file type is error: ' . $file->name);
            return false;
        }

        return true;
    }

    /**
     * @brief 验证上传文件
     * @param UploadedFile $file
     * @param array $allowType 允许上传类型 e.g. ['jpg','png','gif']
     * @param bool $checkMimeType
     * @return bool
     * @since 2016-08-02
     */
    public static function validateUpload(UploadedFile $file, array $allowType, $checkMimeType = false)
    {
        if (!$file instanceof UploadedFile || $file->error == UPLOAD_ERR_NO_FILE) {
            YII_DEBUG and VarDumper::dump('no file be uploaded ');
            return false;
        }

        switch ($file->error) {
            case UPLOAD_ERR_OK:
                return self::checkUploadFileExt($file, $allowType, $checkMimeType);
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                YII_DEBUG and VarDumper::dump('File size too large: ' . $file->name);
                break;
            case UPLOAD_ERR_PARTIAL:
                YII_DEBUG and VarDumper::dump('File was only partially uploaded: ' . $file->name);
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                YII_DEBUG and VarDumper::dump('Missing the temporary folder to store the uploaded file: ' . $file->name);
                break;
            case UPLOAD_ERR_CANT_WRITE:
                YII_DEBUG and VarDumper::dump('Failed to write the uploaded file to disk: ' . $file->name);
                break;
            case UPLOAD_ERR_EXTENSION:
                YII_DEBUG and VarDumper::dump('File upload was stopped by some PHP extension: ' . $file->name);
                break;
            default:
                break;
        }
        return false;
    }

    /**
     * @brief 获取目录下的所有文件
     * note:包括子目录下的文件
     * @param $dir
     * @return array
     * @since
     * @since 2016-06-20
     */
    public static function readDirFile($dir)
    {
        $result = array();
        if (!is_dir($dir)) {
            return $result;
        }

        $fileDir = scandir($dir);
        if (!$fileDir) {
            return $result;
        }

        foreach ($fileDir as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            } elseif (is_dir($dir.$file)) {
                $result = array_merge($result, self::readDirFile($dir.DIRECTORY_SEPARATOR.$file.DIRECTORY_SEPARATOR));
            } else {
                array_push($result, $dir.DIRECTORY_SEPARATOR.$file);
            }
        }

        return $result;
    }

    /**
     * @brief 为文件或文件夹名称添加标志 e.g.  rename 'demo.php' to 'demo_lock.php'
     * @param string $file 文件或文件夹路径
     * @param string $flag
     * @return bool
     * @since 2016-08-15
     */
    public static function addFlag($file, $flag = '_lock')
    {
        if (!self::isExists($file)) {
            return false;
        }
        $pathInfo = pathinfo($file);
        $newName = $pathInfo['dirname'] . DIRECTORY_SEPARATOR . $pathInfo['filename'];
        $newName .= $flag . '.' . $pathInfo['extension'];
        return rename($file, $newName);
    }

    /**
     * @brief 检测文件是否存在，支持别名路劲，支持中文名
     * @param string $file 文件路劲
     * @return bool
     * @since 2016-08-16
     */
    public static function isExists($file)
    {
        $file = Yii::getAlias(StringUtil::transCoding($file, 'UTF-8', 'GBK'));
        return file_exists($file);
    }

    /**
     * @brief 生成新文件名
     * @param $file
     * @param string $newName 自定义新文件名，如果为空，将自动生成一个随机文件名
     * @return mixed
     * @since 2016-08-16
     */
    public static function newName($file, $newName = '')
    {
        $fileInfo = pathinfo($file);
        if (!$newName) {
            $newName = md5(uniqid(microtime(true),true));
        }
        return str_replace($fileInfo['filename'], $newName, $file);
    }

    /**
     * @brief 文件后缀名
     * @param string $file 文件路径或文件名
     * @param bool $flag 后缀是否带点，true返回'.jpg', false返回 'jpg'
     * @return string
     * @since 2016-08-16
     */
    public static function suffix($file, $flag = false)
    {
        $filename = basename($file);
        $start = strrpos($filename, '.', 0);
        $flag == false and $start = $start + 1;
        return substr($filename, $start);
    }

}