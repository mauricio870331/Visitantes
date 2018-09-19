<?php
session_start();

    if (!isset($_SESSION['usuario'])){
        header('Location:index.html');
    }

     include ("funciones_mysql.php");

    $fecha_inicial = $_POST['fecha_ini'];
    $fecha_final = $_POST['fecha_final'];
    $identificacion = $_POST['identificacion'];
    $documento = $_POST['documento'];
    $tipo_vehiculo = $_POST['tipo_vehiculo'];

    $query = "";//validación mediante sentencias sql

    if($documento == 'cedula'){
        if ($identificacion != ""){
            $query = " and v.es_vehiculo ='N' and cedula='".$identificacion."'";
        }else{
            $query = " and v.es_vehiculo ='N'";
        }
    }else{
        if ($identificacion != ""){
            $query = " and v.es_vehiculo ='S' and cedula='".$identificacion."'";
        }else{
            $query = " and v.es_vehiculo ='S'";
        }
    }

    if ($tipo_vehiculo != ""){
	$_SESSION['tipo_vehiculo'] = $tipo_vehiculo;
        $query .=" and v.tipo_vehiculo = '".$tipo_vehiculo."'";
    }
    $_SESSION['fecha_inicial']= $fecha_inicial;
    $_SESSION['fecha_final']= $fecha_final;
    $_SESSION['identificacion'] = $identificacion;
    $_SESSION['documento'] = $documento;
    


    $conexion = new Conexion("visitantes");

    $sql = "SELECT distinct v.cedula, v.nombre, v.apellido, d.hora_ingreso, d.hora_salida, d.fecha, d.motivo_visita, d.persona_visitada,d.otro FROM tbl_visitante v, tbl_detalle d WHERE v.cedula = d.cedula_visitante  and d.fecha BETWEEN '".$fecha_inicial."' AND '".$fecha_final."'".$query;
	
	
	

    $obj = $conexion->findAll2($sql);



if (count($obj)!=0){
    echo '<a href="exportaexcel_visitantes.php">Exportar a excel</a>';
    echo '<br>';
    echo '</br>';


     echo '<div class="box">';
     echo '<div class="box-header">';
     echo '<h3 class="box-title">Resultado Informe</h3>';
     echo '</div>';
     echo '<div class="box-body">';

    echo '<table class="table table-bordered table-striped" id="t_resultados">';
    echo        '<thead>';
    echo          '<tr>';
    echo           '<th width="58">Cedula</th>';
    echo           '<th width="79">Nombres</th>';
    echo          ' <th width="84">Apellidos</th>';
    echo          ' <th width="58">Hora de ingreso</th>';
    echo          '<th width="70">Hora de salida</th>';
    echo         ' <th width="58">Fecha</th>';
    echo         ' <th width="58">Motivo de visita</th>';
    echo         ' <th width="58">Persona visitada</th>';
    echo               ' <th width="58">OTRO</th>';
    echo       ' </tr>';
    echo '<tbody>';


    foreach ($obj as $valor){
        echo '<tr>';

        echo "<td>",$valor->cedula,"</td>";
        echo "<td>",$valor->nombre,"</td>";
        echo "<td>",$valor->apellido,"</td>";
        echo "<td>",$valor->hora_ingreso,"</td>";
        echo "<td>",$valor->hora_salida,"</td>";
        echo "<td>",$valor->fecha,"</td>";
        echo "<td>",$valor->motivo_visita,"</td>";
        echo "<td>",$valor->persona_visitada,"</td>";
        echo "<td>",$valor->otro,"</td>";
        echo '</tr>';
    }

    echo '</tbody>';
    echo ' </table>';

    echo '</div>';
    echo '</div>';

}

?>
<script>
    $(function () {
        $('#t_resultados').DataTable()

    })
</script>

