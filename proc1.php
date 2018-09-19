<?php
include ("funciones_mysql.php");

$q=$_POST['q'];

$conexion = new Conexion("visitantes");

$sql="SELECT nombre, apellido, hora_ingreso FROM tbl_visitante, tbl_detalle WHERE
 cedula = cedula_visitante AND cedula = '". $q ."' and hora_salida = '00:00:00'";

$obj = $conexion->findAll2($sql);



	if (count($obj)!=0){
		
			foreach ($obj as $resultado){

		echo '<input style="border:none" name="nombre" value="'.$resultado->nombre.'"readonly type="text" class="form-control"/>'."||";
		echo '<input style="border:none" name="apellidos" value="'.$resultado->apellido.'"readonly type="text" class="form-control"/>'."||";
		echo '<input style="border:none" name="hora_ingreso" value="'.$resultado->hora_ingreso.'"readonly type="text" class="form-control"/>'."||";

		}
	}
	else {
	echo "||"."||"."||";
	}
	
	mysqli_close($conexion);

?>