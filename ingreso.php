<?php

    include ('funciones.php');
    date_default_timezone_set('America/Bogota');
    $hora_ingreso = date("H:i:s");
        //uso de la funcion verificar_usuario()
        if (verificar_usuario()){
            //si el usuario es verificado puede acceder al contenido permitido a el
            //echo "$_SESSION[usuario]<br/>";
            $nombre_usuario=$_SESSION['usuario'];

            //print "Desconectarse <a href='salir.php'/>aqui</a>";
        } else {
            //si el usuario no es verificado volvera al formulario de ingreso
            header('Location:login.html');
        }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ingresar</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloadingall of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="javascript/notificaciones.css">
    <link rel="icon" type="image/png" href="imagenes/favicon.png" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  <![endif]-->

    <script src="proc2.php"></script>
    <script src="javascript/ajax3.js"></script>

    <script>

        function  capturarDato(){

            elem=document.getElementsByName('opc1');
            for(i=0;i<elem.length;i++)
                if (elem[i].checked) {
                    valor = elem[i].value;
                    if(valor == "placa"){
                        document.getElementById("tipo_vehiculo").style.display = "block";
                        document.getElementById("t_vehiculo").style.display = "block";

                    }else{
                        document.getElementById("tipo_vehiculo").style.display = "none";
                        document.getElementById("t_vehiculo").style.display = "none";
                    }
                    return;
                }
        }
    </script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green sidebar-mini">
<section class="wrapper">
    <header class="main-header">
        <a class="logo">
            <span class="logo-lg"><b>Visitantes</b></span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu"><!-- Ubica el nombre de usuario al lado derecho superior de la página-->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <span class="hidden-xs" style="margin-right: 150%"><?php echo "<b>".$nombre_usuario."</b>" ?></span>
                        </a>
                        <ul class="dropdown-menu">
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
         <li class="treeview">
              <a href="javascript:void(0)" id="ingresar">
                  <i class="fa fa-user-o"></i>
                  <span>Ingresar Visitantes</span>
              </a>
          </li>
          <li class="treeview">
              <a href="javascript:void(0)"id="salir">
                  <i class="fa fa-sign-out"></i>
                  <span>Salida Visitantes</span>
              </a>
          </li>
          <li class="treeview">
              <a href="javascript:void(0)" id="informe">
                  <i class="fa fa-line-chart"></i>
                  <span>Informes</span>
              </a>
          </li>
          <li class="treeview">
              <a href="javascript:void(0)" id="cerrar_session">
                  <i class="fa fa-power-off"></i>
                  <span>Cerrar Sesión</span>
              </a>
          </li>
      </ul>
    </section>
  </aside>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
       Ingresar visitantes
      </h1>
    </section>
    <section class="content">
      <div class="box-bod" >
          <div id="datos">
		  
<form method="post"  name="ingreso" id="ingreso">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>Fecha</th>
                      <th>Cédula <input type="radio" value="cedula" id="r_cedula" name="opc1" onclick="capturarDato()"><br>
                          Placa <input type="radio" value="placa" id="r_placa" name="opc1" onclick="capturarDato()"></th>
                      <th id="tipo_vehiculo" style="display: none">Tipo Vehiculo</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Hora de ingreso</th>
                      <th>Motivo de visita</th>
                      <th>Persona visitada</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <td><input type="text" disabled readonly name="fecha" id="fecha" value="<?php echo date('Y-m-d');?>" style="width: 80px">
                          <input type="hidden" name="fecha_o" id="fecha_o" value="<?php echo date('Y-m-d');?>"></td>
                      <td><input type="text" name="cedula" size="8" id="cedula"></td>
                      <td id="t_vehiculo" style="display: none">
                          <select id="selec_vehiculo" name="selec_vehiculo" required>
                              <option id="" value="vehiculos">
                              <option value="moto">Moto</option>
                              <option value="carro">Carro</option>
                              <option value="camion">Camión</option>
                              <option value="camioneta">Camioneta</option>
                              <option value="bus">Bus</option>
                              </option>
                          </select>
                      </td>
                      <td><input type="text" name="nombre" id="nombre" required></td>
                      <td><input type="text" name="apellido" id="apellido" required></td>
                      <td><input type="text" name="hora_ingreso" id="hora_ingreso" readonly disabled style="width: 80px" value="<?php echo $hora_ingreso?>" >
                          <input type="hidden" name="hora_ingreso_o" id="hora_ingreso_o" value="<?php echo $hora_ingreso?>"><!-- VALOR QUE SE INSERTA EN EL CAMPO HORA_INGRESO DE LA BD-->
                      </td>
                      <!--MOTIVO_VISITA-->
                      <td style="width: 12%">
                          <?php
                          $ch = curl_init();
                          curl_setopt($ch, CURLOPT_URL, 'http://localhost:6161/WSExpal/webresources/WebSecciones');
                          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                          $output = curl_exec($ch) or die(curl_error($ch));
                          curl_close($ch);
                          $array = json_decode($output, true);//WEB SERVICE
                          ?>

                          <select id='motivo_visita' onchange='load(this.value);prueba();' name='motivo_visita' style="width: 130px" required >

                              <?php
                              echo "<option value='0'>Seleccione</option>";

                              foreach ($array as $key => $valor){
                                  echo "<option>", $valor['desc_seccion']." - ".$valor['cod_seccion'], "</option>";
                              }

                              echo "</select>";
                              $db=null;
                              ?>
                      </td>
                      <!--CIERRE MOTIVO_VISITA-->

                      <!-- PERSONA VISITADA-->
                      <td style="height: 20px;text-align: left">
                          <div id="persona_visitada""></div>
                      </td>
                      <!-- CIERRE PERSONA VISITADA-->

                        <!-- TIPO_VEHICULOS-->
                      <td id="t_vehiculo" style="display:none; width: 60%">
                          <select id="vehiculos" name="vehiculos" style="width:10px;" required>

                              <option value="moto">Moto</option>
                              <option value="carro">Carro</option>
                              <option value="camion">Camión</option>
                              <option value="camioneta">Camioneta</option>
                              <option value="bus">Bus</option>
                          </select>
                      </td>
                        <!-- CIERRE TIPO_VEHICULOS-->
                  </tr>
                  </tbody>

              </table>
          </div>
      </div>
<div style="text-align: center">

    <div style="width:40%;display: inline-block">
        <label >
            COMPUTADOR PORTATIL:
        </label>
            <div style="margin-left: 60px;display: inline">
                  <b>SI</b> <input type="radio" name="optionsRadios" id="optionsRadios" value="1" >
                  <b>NO</b> <input type="radio" name="optionsRadios" id="optionsRadios" value="0" >
            </div>
    </div>
    <div  style="width:40%; display: inline-block">
        <label>
            VIDEO BEAN:
        </label>
            <div style="margin-left: 60px; display: inline">
                <b>SI</b> <input type="radio" name="optionsRadios2" id="optionsRadios2" value="1" >
                <b>NO</b> <input type="radio" name="optionsRadios2" id="optionsRadios2" value="0" >
            </div>
    </div>
    <br>
    <br>
    <div style="display: inline-block;width: 40%">
        <label style="width:47%">
            CELULAR:
        </label>
        <div style="width:50%;display: inline">
                <b>SI</b>  <input type="radio" name="optionsRadios3" id="optionsRadios3" value="1" >
                <b>NO</b>  <input type="radio" name="optionsRadios3" id="optionsRadios3" value="0" style="text-align: center">
            </div>
    </div>
    <div style="display: inline-block; width: 40%">
        <label style="width: 17%;">
            MALETIN:
        </label>
            <div style="margin-left: 60px; display: inline">
                <b>SI</b>  <input type="radio" name="optionsRadios4" id="optionsRadios4" value="1" >
                <b>NO</b> <input type="radio" name="optionsRadios4" id="optionsRadios4" value="0" >
            </div>
    </div>
    <br>
    <br>
    <div style="margin-right:  412px; display: inline-block">
        <div style="margin-left: 60px; display: inline">
            <label>
                OTRO: <input type="text" name="otro" id="otro" autocomplete="off" >
            </label>
        </div>
    </div>
</div>
    <br/>
    <div style="text-align: center">
        <input type="hidden" name="opc" id="opc" value="verificar">
        <input type="button" value="Ingresar" name="ingresar" id="ingresar" style="margin-right: 50px" onclick="validarSelect()">
    </div>
    </form>
    </section>
  </div>

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
      <script src="javascript/funciones.js"></script>
<script src="dist/js/demo.js"></script>
      <script src="javascript/notificaciones.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()

      var mensaje = getParameterByName('mensaje');

      if (mensaje == 'salida') {
          showAlert("Salida de visitante registrada", "success", 250, 60);
      }

      if (mensaje == 'ingreso') {
          showAlert("Ingreso Registrado", "success", 250, 60);
		  window.open('reporte.php', '_blank');
		  window.location.href="ingreso.php";
      }

      if (mensaje == 'bienvenido') {
          showAlert("Bienvenido Usuario: <?php echo $nombre_usuario; ?>", "success", 250, 60);

      }
	  
	  if(mensaje == 'val_ingreso'){//MENSAJE VALIDACIÓN PARA INGRESAR
		showAlert("Ya hay un ingreso de esta persona, por favor realice la salida..!","error",300,70);
	  }

      $("#ingresar").click(function () {
          window.location.href="ingreso.php";

      }) ;

      $("#salir").click(function () {
          window.location.href="salida.php";

      }) ;
      $("#informe").click(function () {
          window.location.href="informe_visitantes.php";

      }) ;
      $("#cerrar_session").click(function () {
          window.location.href="salir.php";

      }) ;

      function getParameterByName(name) {
          name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
          var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
              results = regex.exec(location.search);
          return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
      }

      function showAlert(mensaje, cssClas, width, height) { //info,error,success
          if ($("#notificaciones").length == 0) {
//creamos el div con id notificaciones
              var contenedor_notificaciones = $(window.document.createElement('div')).attr("id", "notificaciones");
              //a continuación la añadimos al body
              $('body').append(contenedor_notificaciones);
          }
//llamamos al plugin y le pasamos las opciones
          $.notificaciones({
              mensaje: mensaje,
              width: width,
              cssClass: cssClas, //clase de la notificación
              timeout: 4000, //milisegundos
              fadeout: 1000, //tiempo en desaparecer
              radius: 5, //border-radius
              height: height
          });
      }
  })
  
  function validarSelect(){
	var select = $("#motivo_visita").val();
	var select_personal = $("#personal").val();
	
	

	
	if(((select != 'ALMACEN AFILIADOS - ALAF') || (select  != 'ENCOMIENDAS - ENCO') || (select  != 'LAVADEROS - LAVA') 
	|| (select != 'SERVIAFIL - SERVI')  || (select != 'SECRETARIAS - SECR')  || (select != 'CASINO - CASINO '))){
		
	}else{
	  if(select_personal==0){
	     alert("La opción persona visitada es obligatoria"); 
	      return false;
	  }	  
	}	

	document.ingreso.action = "registrar_datos.php";
	document.ingreso.submit();
	
  }
  
  
  function prueba(){
	var select = $("#motivo_visita").val();
	console.log(select);
  }
</script>
</body>
</html>