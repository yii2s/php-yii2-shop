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
     * @author wuzhc 2016-08-02
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
        if ($upload && self::validateUpload($upload, $allowType, $checkMimeType)) {
                $name = $upload->name;
                $savePath = $target.$name;
                if ($upload->saveAs($savePath)) {
                    return mb_convert_encoding($savePath, 'utf-8', 'gbk');
                }
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
     * @author wuzhc 2016-08-02
     */
    public static function checkUploadFileExt(UploadedFile $file, array $allowType, $checkMimeType = false)
    {
        $extension = mb_strtolower($file->extension, 'utf-8');

        // check file by mimeType
        if ($checkMimeType) {
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
     * @author wuzhc 2016-08-02
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


}