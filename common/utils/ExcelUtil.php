<?php
namespace common\utils;

use Yii;

//require relation class files
require(Yii::getAlias("@common").'/components/excel/PHPExcel.php');
require(Yii::getAlias("@common").'/components/excel/PHPExcel/Writer/Excel2007.php');

class ExcelUtil {

    /**
     * @biref 导出数据
     * @param $data [[1, "小明", "25"]]
     * @param $header ["id", "姓名", "年龄"]
     * @param string $title
     * @param string $filename
     * @return bool
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Writer_Exception
     * @author wuzhc 2016-08-02
     */
    public static function export($data, $header, $title = "simple", $filename = "data")
    {
        if (!is_array ($data) || !is_array ($header)) {
            return false;
        }

        $objPHPExcel = new \PHPExcel();

        // Set properties
        $objPHPExcel->getProperties()->setCreator("zcShop");
        $objPHPExcel->getProperties()->setLastModifiedBy("zcShop");
        $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Document");
        $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Document");
        $objPHPExcel->getProperties()->setDescription("Document for Office 2007 XLSX, generated using zcShop.");

        // Set first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        //add header
        $hk = 0;
        foreach ($header as $k => $v)
        {
            $index = \PHPExcel_Cell::stringFromColumnIndex($hk);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($index."1", $v);
            $hk += 1;
        }

        $row = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();
        foreach($data as $key => $rows)  //add data to row
        {
            $span = 0;
            foreach($rows as $keyName => $value) // add data to column
            {
                $index = \PHPExcel_Cell::stringFromColumnIndex($span);
                $objActSheet->setCellValue($index.$row, $value);
                $span++;
            }
            $row++;
        }

        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle($title);

        // Save Excel 2007 file
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        header("Pragma:public");
        header("Content-Type:application/x-msexecl;name=\"{$filename}.xls\"");
        header("Content-Disposition:inline;filename=\"{$filename}.xls\"");
        $objWriter->save("php://output");
    }

    /**
     * @brief 读取数据
     * @param string $filePath excel文件路径
     * @param bool $isReadAllSheet 是否读取所有工作簿的数据
     * @return array ['data'=>['excel数据集合'], 'status' => '1失败，0成功', 'msg' => '提示信息']
     * @author wuzhc 2016-08-02
     */
    public static function read($filePath = '', $isReadAllSheet = false)
    {
        if (!file_exists($filePath)) {
            return ['data' => [], 'status' => 1, 'msg' => 'File is not exist'];
        }

        $PHPExcel = new \PHPExcel();
        $PHPReader = new \PHPExcel_Reader_Excel2007();
        if (!$PHPReader->canRead($filePath)) {
            $PHPReader = new \PHPExcel_Reader_Excel5();
            if (!$PHPReader->canRead($filePath)) {
                return ['data' => [], 'status' => 1, 'msg' => 'Can not read file'];
            }
        }

        $PHPExcel = $PHPReader->load($filePath); //Reader读出来后，加载给Excel实例
        $data = null;
        if ($isReadAllSheet !== false)
        {
            $allSheet = $PHPExcel->getSheetCount();
            for ($i=0; $i<$allSheet; $i++) {
                $currentSheet = $PHPExcel->getSheet($i);
                $data[] = $currentSheet->toArray('', true, true); //把当前sheet转为二维数组
            }
        }
        else
        {
            $currentSheet = $PHPExcel->getSheet(0);
            $data = $currentSheet->toArray('', true, true); //把当前sheet转为二维数组
        }

        return ['data'=> $data, 'status'=>0, '读取成功'];
    }

}