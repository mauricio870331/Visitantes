<?php

    include("funciones_mysql.php");
	
	  
    $cedula=$_POST['cedula'];
    $nombre=$_POST['nombre'];
    $apellido= $_POST['apellido'];
    $hora_ingreso = $_POST['hora_ingreso_o'];
    $hora_salida = $_POST['h_salida'];

    $conexion = new Conexion("visitantes");

    try{

        $sql = "UPDATE tbl_detalle SET hora_salida ='". $hora_salida ."' WHERE cedula_visitante = '". $cedula ."' and hora_salida is null";
        $conexion->execQuery($sql);
        header("location:ingreso.php?mensaje=salida");
    }catch (Exception $e){
        echo "Mensaje Error: ".$e->getMessage();

    }

?>