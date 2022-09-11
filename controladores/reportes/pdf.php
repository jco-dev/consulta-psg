<?php

$ruta = dirname(__DIR__);
$ruta = str_replace("controladores", "", $ruta);

if (isset($_POST["pdf"])) {
    require('../../libraries/fpdf/fpdf.php');
    require('../../modelos/usuario.modelo.php');

    $usuario = new ModeloUsuario();
    $usuarios = $usuario->mdlMostrarUsuarios(null, null, null);

    // var_dump($usuarios);
    // die();

    $pdf = new FPDF("P", "mm", [220, 280]);
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);


    $pdf->Cell(200, 10, 'REPORTE DE USUARIOS', 0, 1, "C");

    $pdf->image($ruta . 'vistas/dist/images/logo.png', 15, 5, 30, 30, 'png');

    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(10, 10, '#', 0, 0, "C");
    $pdf->Cell(40, 10, 'Nombre', 0, 0, "C");
    $pdf->Cell(40, 10, 'Paterno', 0, 0, "C");
    $pdf->Cell(40, 10, 'Materno', 0, 0, "C");
    $pdf->Cell(70, 10, 'Correo', 0, 1, "C");

    //linea con color
    $pdf->SetLineWidth(1);
    $pdf->SetDrawColor(48, 91, 164);
    $pdf->Line(10, 40, 210, 40);


    $pdf->SetLineWidth(0.5);
    $pdf->SetDrawColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 11);

    $contador = 1;
    foreach ($usuarios as $usuario) {
        $pdf->Cell(10, 8, $contador, "B", 0, "C");
        
        $pdf->Cell(40, 8, utf8_decode($usuario["nombre"]), "B", 0, "C");
        $pdf->Cell(40, 8, utf8_decode($usuario["paterno"]), "B", 0, "C");
        $pdf->Cell(40, 8, utf8_decode($usuario["materno"]), "B", 0, "C");
        $pdf->Cell(70, 8, utf8_decode($usuario["usuario"]), "B", 1, "C");


        $contador++;
    }


    $pdf->Output();
}
