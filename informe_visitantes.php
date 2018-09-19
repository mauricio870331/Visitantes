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
  <title>Informe Visitantes</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="icon" type="image/png" href="imagenes/favicon.png" />
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  <![endif]-->
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
                <li class="dropdown user user-menu">
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
       Informe
      </h1>
    </section>
    <section class="content">
      <div class="box-bod" >
          <div id="datos">
<form>
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>Fecha Inicial</th>
                      <th>Fecha Final</th>
                      <th style="width: 25%;">Identificación</th>
                      <th id="tipo_vehiculo" style="display: none">Tipo Vehiculo</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <td>
                          <input type="date" id="fecha_ini" name="fecha_ini">
                      </td>

                      <td>
                          <input type="date" id="fecha_final" name="fecha_final">

                      </td>

                      <td>
                          <b>Cédula</b> <input type="radio" checked value="cedula" id="r_cedula" name="opc1" onclick="capturarDato()">
                          <b>Placa</b> <input type="radio" value="placa" id="r_placa" name="opc1" onclick="capturarDato()">

                          <input type="text" name="identificacion" id="identificacion" style="width: 80px;margin-left: 16px" >
                      </td>

                      <td id="t_vehiculo" style="display: none">
                          <select id="selec_vehiculo" name="selec_vehiculo">
                              <option value="">Seleccione</option>
                              <option value="moto">Moto</option>
                              <option value="carro">Carro</option>
                              <option value="camion">Camión</option>
                              <option value="camioneta">Camioneta</option>
                              <option value="bus">Bus</option>
                          </select>
                      </td>
                  </tr>
                  </tbody>

              </table>
          </div>
      </div>
    <br/>
    <div style="text-align: center">
        <input type="button" value="Consultar" name="consultar" id="consultar">
        <img src="imagenes/carga.gif" style="height: 20px; display: none; " id="carga">
    </div>
    </form>
        <br>
        <div id="resultado"></div>
    </section>
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
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE for demo purposes -->
      <script src="javascript/funciones.js"></script>
<script src="dist/js/demo.js"></script>
<script>
  $(document).ready(function () {

    $('.sidebar-menu').tree()

  })

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
</script>
</body>
</html>
