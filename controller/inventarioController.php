<?php
require_once '../model/inventario.php';

switch ($_GET["op"]) {
    case 'listar_para_tabla':
        $inventario = new Inventario();
        $inventarios = $inventario->listarInventarioDb();
        $data = array();       

        foreach ($inventario as $reg) {
            $data[] = array(
                $reg->getProvedor(),
                $reg->getubicacion(),
                $reg->getCantidad()

            );
            
        }

        

        // Construye el resultado como un simple array de datos
        $resultados = array(
            "sEcho" => 1, // Información para datatables
            "iTotalRecords" => count($data), // Total de registros al datatable
            "iTotalDisplayRecords" => count($data), // Total de registros a visualizar
            "aaData" => $data
        );

        // Envía el JSON con los resultados
        echo json_encode($resultados);
        break;
       
}