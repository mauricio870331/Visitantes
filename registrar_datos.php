<?php
    session_start();
    

    include("funciones_mysql.php");
	  mysqli_set_charset('utf8');

    $fecha = $_POST['fecha_o'];
    $cedula = $_POST['cedula'];
	$datosCedula = explode(" ", $cedula);
    if (count($datosCedula)>1){
        $cedula = trim($datosCedula[0]).trim($datosCedula[1]);
    }
    $_SESSION['cedula'] = $cedula;
	$opcion = ($_POST['opc1']=='cedula') ? 'N' : 'S';
    $selec_vehiculo = ($_POST['opc1']=='placa') ? $_POST['selec_vehiculo'] : 'null';
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $hora_ingreso = $_POST['hora_ingreso_o'];
    $motivo_visita  = $_POST['motivo_visita'];
    $personal = $_POST['personal'];
    $radio_cportatil = $_POST['optionsRadios'];
    $video_bean = $_POST['optionsRadios2'];
    $celular = $_POST['optionsRadios3'];
    $maletin = $_POST['optionsRadios4'];
    $otro = $_POST['otro'];
    $usuario_porteria = $_SESSION['usuario'];
    $datos=explode("-",$personal);

    try{
        $conexion = new Conexion('visitantes');
	
		
		
		$queryValidar= "SELECT cedula FROM tbl_visitante WHERE  cedula = '".$cedula."'"; 		
		$r= $conexion->findAll2($queryValidar);
		
		
		if(count($r)==0){
			$sql="INSERT INTO tbl_visitante(cedula,nombre,apellido,es_vehiculo,tipo_vehiculo)VALUES (UPPER('$cedula'),'$nombre','$apellido','$opcion','$selec_vehiculo')";
			$conexion->execQuery($sql);
		}	
		
		$sql_confirmar = "SELECT hora_salida FROM tbl_detalle WHERE  hora_salida is NULL and cedula_visitante = '".$cedula."' order by hora_salida desc limit 1"; 		
		$resultado = $conexion->findAll2($sql_confirmar);		
		if(count($resultado) == 0){  		   
					
			$sql2="INSERT INTO tbl_detalle(hora_ingreso,hora_salida,motivo_visita,fecha,id_porteria,cedula_visitante,computador,video_bean,celular,maletin,otro,cargo,persona_visitada)
			   VALUES ('$hora_ingreso',NULL,'$motivo_visita','$fecha','$usuario_porteria','$cedula','$radio_cportatil','$video_bean','$celular','$maletin','$otro','$datos[1]','$datos[0]')";		   
			
			
			$conexion->execQuery($sql2);										
			header("location:ingreso.php?mensaje=ingreso");
		
		}else{
			
			header("location:ingreso.php?mensaje=val_ingreso");
		}	
        

    }catch (Exception $e){
        echo  "Mensaje de error: " .$e->getMessage()."<br>";
        echo "Linea de error: " .$e->getLine();
    }

?>