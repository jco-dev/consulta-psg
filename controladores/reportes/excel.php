<?php

// no dejar espacios en blanco antes de la etiqueta php
require('../../vendor/autoload.php');


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;




if (isset($_POST["excel"])) {

    require('../../modelos/usuario.modelo.php');


    $usuario = new ModeloUsuario();
    $usuarios = $usuario->mdlMostrarUsuarios(null, null, null);



    $spreadsheet = new Spreadsheet();

    // $spreadsheet->getActiveSheet()->setCellValue('A1', 'Hello World !');
    // $sheet = $spreadsheet->getActiveSheet();
    $spreadsheet->setActiveSheetIndex(0);
    $spreadsheet->getActiveSheet()->setTitle('REPORTE');

    $spreadsheet->getActiveSheet()->mergeCells("A2:E2")->setCellValue("A2", htmlspecialchars("REPORTE DE USUARIOS"));
    $spreadsheet->getActiveSheet()->mergeCells("A3:E3")->setCellValue("A3", htmlspecialchars("CURSOS POSGRADO"));

    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(18);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(40);


    $contador = 5;

    $spreadsheet->getActiveSheet()->setCellValue("A" . $contador, 'NRO');
    $spreadsheet->getActiveSheet()->setCellValue("B" . $contador, 'NOMBRE');
    $spreadsheet->getActiveSheet()->setCellValue("C" . $contador, 'PATERNO');
    $spreadsheet->getActiveSheet()->setCellValue("D" . $contador, 'MATERNO');
    $spreadsheet->getActiveSheet()->setCellValue("E" . $contador, 'CORREO');


    $indice = 1;
    $contador++;
    foreach ($usuarios as $usuario) {
        $spreadsheet->getActiveSheet()->setCellValue("A" . $contador, $indice);
        $spreadsheet->getActiveSheet()->setCellValue("B" . $contador,  $usuario["nombre"]);
        $spreadsheet->getActiveSheet()->setCellValue("C" . $contador,  $usuario["paterno"]);
        $spreadsheet->getActiveSheet()->setCellValue("D" . $contador, $usuario["materno"]);
        $spreadsheet->getActiveSheet()->setCellValue("E" . $contador,  $usuario["usuario"]);

        $indice++;
        $contador++;
    }



    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="REPORTES_EXCEL.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');



}
