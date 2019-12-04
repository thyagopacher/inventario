<?php

    set_time_limit(0);
    include("../control/mpdf/mpdf.php");
    define('MPDF_PATH', '../control/mpdf/');
    if(isset($paisagem) && $paisagem != NULL && $paisagem != ''){
        $mpdf=new mPDF('utf-8', 'A4-L');
    }else{
        $mpdf = new mPDF();
    }
    
    $mpdf->useSubstitutions = false;
    $mpdf->simpleTables = true;
    $mpdf->SetDisplayMode("fullpage");
    $mpdf->WriteHTML('<link rel="stylesheet" href="../visao/recursos/css/tabela.min.css" type="text/css"><style>.nrelatorio{display: none}</style>'.$html, 0, true, false);
    $mpdf->Output();
    
