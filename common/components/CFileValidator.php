<?php
namespace common\components;


use Yii;
use yii\helpers\VarDumper;
use yii\validators\FileValidator;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class CFileValidator
{
    public $error;
    public $allowType = [];
    public $maxSize;
    public $maxFiles = 1;

    public function __construct($allowType = [], $maxSize = 0, $maxFiles = 1)
    {
        $this->allowType = $allowType ?: array_keys(Yii::$app->params['fileExt']);
        $this->allowType = array_map('strtolower', $this->allowType);
        $this->maxSize = $maxSize;
        $this->maxFiles = $maxFiles;
    }

    /**
     * @brief 验证上传文件
     * @param UploadedFile $file
     * @return bool
     */
    public function validateUpload(UploadedFile $file)
    {
        if (!$file instanceof UploadedFile || $file->error == UPLOAD_ERR_NO_FILE) {
            return false;
        }

        switch ($file->error) {
            case UPLOAD_ERR_OK:
                $this->checkUploadFileExt($file);
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $this->error = 'File size too large: ' . $file->name;
                break;
            case UPLOAD_ERR_PARTIAL:
                $this->error = 'File was only partially uploaded: ' . $file->name;
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $this->error = 'Missing the temporary folder to store the uploaded file: ' . $file->name;
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $this->error = 'Failed to write the uploaded file to disk: ' . $file->name;
                break;
            case UPLOAD_ERR_EXTENSION:
                $this->error = 'File upload was stopped by some PHP extension: ' . $file->name;
                break;
            default:
                break;
        }
        return false;
    }

    public function checkUploadFileExt($file)
    {
        $extension = mb_strtolower($file->extension, 'utf-8');

        $mimeType = FileHelper::getMimeType($file->tempName, null, false);
        if ($mimeType === null) {
            $this->error = 'file mimeType is null: ' . $file->name;
            return false;
        }

        $extensionsByMimeType = FileHelper::getExtensionsByMimeType($mimeType);
        if (!in_array($extension, $extensionsByMimeType, true)) {
            $this->error = 'file type is limit: ' . $file->name;
            return false;
        }

        if (!in_array($extension, $this->allowType, true)) {
            $this->error = 'file type is limit: ' . $file->name;
            return false;
        }

        return true;
    }
}