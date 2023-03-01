<?php
/*--------------------------------------------------------------
* Función encargada de exportar a excel.
* Recibe como parametro un arreglo de datos.
*---------------------------------------------------------------*/

function exportTableDatabase($productResult) {

    $timestamp = time();
    $filename = 'qmedic_data_' . $timestamp . '.xls';
    
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    
    $isPrintHeader = false;

    foreach ($productResult as $row) {

        if (! $isPrintHeader ) {

            echo implode("\t", array_keys($row)) . "\n";
            $isPrintHeader = true;

        }

        echo implode("\t", array_values($row)) . "\n";

    }

    exit();

}
// $data= $controllerData->campaign($_GET('id'));
// exportTableDatabase($data);
?> 