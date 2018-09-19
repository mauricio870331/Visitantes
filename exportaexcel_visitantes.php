<?php
    session_start();
    include("funciones_mysql.php");

$query = "";//validación mediante sentencias sql

    if($_SESSION['documento'] == 'cedula'){
        if ($_SESSION['identificacion'] != ""){
            $query = " and es_vehiculo ='N' and cedula='".$_SESSION['identificacion']."'";
        }else{
            $query = " and es_vehiculo ='N'";
        }
    }else{
        if ($_SESSION['identificacion'] != ""){
            $query = " and es_vehiculo ='S' and cedula='".$_SESSION['identificacion']."'";
        }else{
            $query = " and es_vehiculo ='S'";
        }
    }

    if (isset($_SESSION['tipo_vehiculo']) && $_SESSION['tipo_vehiculo'] !=""){ 
        $query .=" and tipo_vehiculo = '".$_SESSION['tipo_vehiculo']."'";
    }



$conexion = new Conexion("visitantes");

$sql = "SELECT cedula, nombre, apellido, hora_ingreso, hora_salida, fecha, motivo_visita, persona_visitada,otro
         FROM tbl_visitante, tbl_detalle WHERE cedula = cedula_visitante and 
       fecha BETWEEN '".$_SESSION['fecha_inicial']."' AND '".$_SESSION['fecha_final']."'".$query;


$titulo = "Listado Visitantes";


$tbHtml = "<table>
            <header>
                <tr><th colspan='7'>".$titulo." Desde: ".$_SESSION['fecha_inicial']." Hasta: ".$_SESSION['fecha_final']."</th></tr>
                <tr>
				   <th>Cédula</th>
                   <th>Nombre</th>
				   <th>Apellido</th>
				   <th>Hora Ingreso</th>
				   <th>Hora Salida</th>
				   <th>Feha</th>
				   <th>Motivo Visita</th>
				   <th>Persona Visitada</th>
				   <th>Otro</th>
				   						
				   						
			    </tr>
            </header>";


    $conexion = new Conexion("visitantes");



$resultado =$conexion->findAll2($sql);

foreach ($resultado as $value){

    $tbHtml .= "<tr>";
    $tbHtml .= "<td>".utf8_decode($value->cedula)."</td>";
    $tbHtml .= "<td>".utf8_decode($value->nombre)."</td>";
    $tbHtml .= "<td>".utf8_decode($value->apellido)."</td>";
    $tbHtml .= "<td>".utf8_decode($value->hora_ingreso)."</td>";
    $tbHtml .= "<td>".utf8_decode($value->hora_salida)."</td>";
    $tbHtml .= "<td>".utf8_decode($value->fecha)."</td>";
    $tbHtml .= "<td>".utf8_decode($value->motivo_visita)."</td>";
    $tbHtml .= "<td>".utf8_decode($value->persona_visitada)."</td>";
    $tbHtml .= "<td>".utf8_decode($value->otro)."</td>";
    $tbHtml .= "</tr>";

}

$tbHtml .= "</table>";
$tbHtml .= "<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />";

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Listado_Visitantes.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo $tbHtml;
?>