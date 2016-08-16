<?php

namespace common\utils;


use Yii;
use common\config\Conf;
use Imagine\Image\ManipulatorInterface;
use yii\imagine\Image;

class ImageUtil
{

    /**
     * @brief 图片缩略图
     * @param string $file 文件路径
     * @param int $w 缩放宽度
     * @param int $h 缩放高度
     * @param string $mode 缩放模式，
     * 'inset' 根据原图片宽高比例等比缩放，如果不能填充满新图片，用白色填充剩余部分
     * 'outbound' 根据原图片宽高比例等比缩放，如果不能填充满新图片，将会裁剪到多余部分，以保证填充满整个新图片，
     * @param string $newName 新名称，为空时将自动生成
     * @return string
     */
    public static function thumbnail($file, $w, $h, $mode = '', $newName = '')
    {
        if (!FileUtil::isExists($file)) {
            return '';
        }

        $filename = basename($file, FileUtil::suffix($file, true));
        $newName or $newName = $filename . '_' . Conf::IMG_THUMB . '_' . $w . '_' . $h;
        $newName = FileUtil::newName($file, $newName);

        $mode or $mode = ManipulatorInterface::THUMBNAIL_OUTBOUND;
        $img = Image::thumbnail($file, $w, $h, $mode);
        $img->save($newName, ['quality' => 70]);
        return $newName;
    }

    /**
     * @brief 裁剪图片
     * @param string $file 文件路径
     * @param int $w 裁剪宽度
     * @param int $h 裁剪高度
     * @param array $start [0,0] 裁剪起始位置
     * @param string $newName 保存新名称，为空时将自动生成
     * @return string
     * @author wuzhc 2016-08-16
     */
    public static function crop($file, $w, $h, array $start, $newName = '')
    {
        if (!FileUtil::isExists($file)) {
            return '';
        }

        $filename = basename($file, FileUtil::suffix($file, true));
        $newName or $newName = $filename . '_' . Conf::IMG_CROP . '_' . $w . '_' . $h;
        $newName = FileUtil::newName($file, $newName);

        $img = Image::crop($file, $w, $h, $start);
        $img->save($newName);
        return $newName;
    }

    /**
     * @brief 添加图片水印
     * @param string $file 文件路径
     * @param array $start 添加位置 [-1,-1]表示底部
     * @param string $watermarkFilename 水印图片，为空时使用系统默认水印图片
     * @return string
     * @author wuzhc 2016-08-16
     */
    public static function watermark($file, array $start, $watermarkFilename = '')
    {
        if (!FileUtil::isExists($file)) {
            return '';
        }

        if (!$watermarkFilename) {
            $watermarkFilename = Yii::getAlias('@public') . DIRECTORY_SEPARATOR . 'common';
            $watermarkFilename .=  DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . Conf::WATER_MARK;
        }

        if ($start[0] === -1 && $start[1] === -1) {
            list($ow,$oh) = getimagesize($file);
            list($ww,$wh) = getimagesize($watermarkFilename);
            $start = [($ow-$ww), ($oh-$wh)];
        }

        $img = Image::watermark($file, $watermarkFilename, $start);
        $img->save($file);
        return $file;
    }
}