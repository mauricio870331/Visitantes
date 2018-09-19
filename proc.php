<?php

header('Content-Type: application/json');
include ("funciones_mysql.php");

	$q=$_POST['cedula'];
	$datosCedula = explode(" ", $q);
		if (count($datosCedula)>1){
        $q = trim($datosCedula[0]).trim($datosCedula[1]);
	}
$opc = $_POST['opc'];
$conexion = new Conexion("visitantes");
if ($opc=='verificar'){
    $sql2 = "SELECT nombre, apellido, CURTIME() as hora_ingreso FROM tbl_visitante WHERE 
    cedula =  '". $q ."'";
}else{
    $sql2 = "SELECT a.nombre, a.apellido, b.hora_ingreso as hora_ingreso FROM tbl_visitante a inner join tbl_detalle b on a.cedula = b.cedula_visitante 
    and cedula =  '". $q ."'";
}

$obj = $conexion->findAll2($sql2);
		//Registro nuevo

    $array = array();
	
	if (count($obj)!=0){

            $array['nombre'] = $obj[0]->nombre;
			$array['apellido'] = $obj[0]->apellido;
            $array['hora_ingreso'] = $obj[0]->hora_ingreso;
			$array['codigo'] = 'ok';

	}
	else{
	//No existe el usurio en la BD
			$array['codigo'] = 'no';
    
	}

    $conexion->desconectar();


    echo json_encode($array, JSON_FORCE_OBJECT);
	
	?>