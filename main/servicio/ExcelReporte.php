<?php

/**
 * Created by PhpStorm.
 * User: estudiante
 * Date: 07/06/2017
 * Time: 01:20 PM
 */
require_once __DIR__ . '/../excel/PHPExcel.php';
require_once __DIR__ . '/../excel/PHPExcel/IOFactory.php';
require_once __DIR__ . '/../excel/PHPExcel/Writer/Excel5.php';

class ExcelReporte
{
    private $contratos;

    public function __construct($contrato)
    {
        $this->contratos = $contrato;
    }

    public function generarReporte2()
    {
        $objPHPExcel = new PHPExcel;
// set syles
        $objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
        $objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
// writer will create the first sheet for us, let's get it
        $objSheet = $objPHPExcel->getActiveSheet();
        $objSheet->setTitle('RESULTADOS');


//Informacion de Columnas y Titulos

        $styleArray = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
            'borders' => array(
                'top' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                ),
            )
        );

        $objSheet->setCellValue("A1","NOMBRE");

        $objSheet->setCellValue("B1","DOCUMENTO");
        $objSheet->setCellValue("C1","DEPENDENCIA");
        $objSheet->setCellValue("D1","VALOR");
        $objSheet->setCellValue("E1","VALOR ASEGURADO");
        $objSheet->setCellValue("F1","INICIA");
        $objSheet->setCellValue("G1","VENCE EN");
        $objSheet->getStyle('A1:G1')->applyFromArray($styleArray);
        $objSheet->getRowDimension('1')->setRowHeight(40);

        $i=2;
        foreach($this->contratos as $contrato){
            $objSheet->setCellValue("A$i", $contrato->supervisorRazonSocial);
            $objSheet->setCellValue("B$i", $contrato->supervisor);
            $objSheet->setCellValue("C$i", $contrato->objetoContrato);
            $objSheet->setCellValue("D$i", $contrato->valor);
            $objSheet->setCellValue("E$i", $contrato->valor);
            $objSheet->setCellValue("F$i", $contrato->fechaInicio);
            $objSheet->setCellValue("G$i", $contrato->fechaFin);
            $objSheet->getRowDimension($i)->setRowHeight(80);
            $i++;
        }

        //$cellIterator = $objSheet->getRowIterator()->current()->getCellIterator();
        //$cellIterator->setIterateOnlyExistingCells(true);
        /** @var PHPExcel_Cell $cell */
        /*foreach ($cellIterator as $cell) {
            $objSheet->getColumnDimension($cell->getColumn())->setAutoSize(true);

        }*/


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Reporte.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function generarReporte()
    {
        $excel = new PHPExcel();
        //Informacion del excel
        $excel->
        getProperties()
            ->setCreator("SCP")
            ->setLastModifiedBy("SCP")
            ->setTitle("Reporte SCP")
            ->setSubject("Contratos")
            ->setDescription("reporte en excel de las polizas")
            ->setKeywords("excel reportes")
            ->setCategory("oficina");
        $activeSheet = $excel->getActiveSheet(0);
        $i = 0;

        foreach ($this->contratos as $contrato) {
            $activeSheet->setCellValue("A$i", $contrato->supervisorRazonSocial);
            $activeSheet->setCellValue("B$i", $contrato->supervisor);
            $activeSheet->setCellValue("C$i", $contrato->objetoContrato);
            $activeSheet->setCellValue("D$i", $contrato->valor);
            $activeSheet->setCellValue("E$i", $contrato->valor);
            $activeSheet->setCellValue("F$i", $contrato->fechaInicio);
            $activeSheet->setCellValue("G$i", $contrato->fechaFin);
            $i++;
        }
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="reporte.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $objWriter->save('php://output');

    }

}