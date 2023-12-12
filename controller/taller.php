<?php
    require_once("../config/conexion.php");
    require_once("../models/Taller.php");
    $taller = new Taller();

    switch ($_GET["op"]){

        case "listar":
            $datos=$taller->get_taller();
            $data = Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["taller_nom"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["taller_id"].');"  id="'.$row["taller_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["taller_id"].');"  id="'.$row["taller_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
                $data[]=$sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            break;


        case "guardaryeditar":
            $datos=$taller->get_taller_x_id($_POST["taller_id"]);
            if(empty($_POST["taller_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $taller->insert_taller($_POST["taller_nom"]);
                }
            }else{
                $taller->update_taller($_POST["taller_id"],$_POST["taller_nom"]);
            }
            break;


        case "mostrar":
            $datos=$taller->get_taller_x_id($_POST["taller_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["taller_id"] = $row["taller_id"];
                    $output["taller_nom"] = $row["taller_nom"];
                }
                echo json_encode($output);
            }
            break;


        case "eliminar":
            $taller->delete_taller($_POST["taller_id"]);
            break;
        }
    ?>