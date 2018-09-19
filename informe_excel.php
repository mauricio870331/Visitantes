<?php
   include ("funciones_mysql.php");
//session_start();
$fecha_inicial = @$_SESSION['fecha_inicial'];
$fecha_final = @$_SESSION['fecha_final'];
$cerrar_tabla = "</table>";


$tbHtml = "<table>
             <header>
                <tr>
                  <th>Cedula</th>
				   <th>Nombre</th>
				    <th>Apellido</th>
					 <th>Hora de ingreso</th>
					  <th>Hora de salida</th>
					   <th>Fecha</th>
					    <th>Motivo de visita</th>
						<th>Persona visitada</th>
						<th>OTRO</th>
                </tr>
            </header>";
			
    $conexion = new Conexion("visitantes");
     $sql = "SELECT cedula, nombre, apellido, hora_ingreso, hora_salida, fecha, motivo_visita, persona_visitada,otro FROM tbl_visitante, tbl_detalle WHERE cedula = cedula_visitante and 
     fecha BETWEEN '".$fecha_inicial."' AND '".$fecha_final."'";
     $obj = $conexion->findAll2($sql);
	
	foreach ($obj  as $valor) {

        echo '<tr>';

            echo "<td>". $valor->cedula."</td>";
            echo "<td>". $valor->nombre."</td>";
            echo "<td>". $valor->apellido."</td>";
            echo "<td>". $valor->hora_ingreso."</td>";
            echo "<td>". $valor->hora_salida."</td>";
            echo "<td>". $valor->fecha. "</td>";
            echo "<td>". $valor->motivo_visita. "</td>";
            echo "<td>". $valor->persona_visitada."</td>";
            echo "<td>". $valor->otro."</td>";
            echo '</tr>';

    }
        echo '</tr>';


 /*$tbHtml .=  "<tr>";
			for($i=0; $i<count($campo); $i++)
     $tbHtml .=  '<td>'.$campo[$i].'</td>';
$tbHtml .=  "</tr>";
		
		 }
	 $tbHtml .= "</html>";*/

 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Informe_visitantes.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo $tbHtml;
echo $cerrar_tabla;

?>