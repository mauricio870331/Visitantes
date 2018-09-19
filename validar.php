<?php
include ('funciones_mysql.php');
//usuario y clave pasados por el formulario
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
//usa la funcion conexiones() que se ubica dentro de funciones.php

    $conexion = new Conexion("visitantes");

    $rs = $conexion->login($usuario,$clave);


    if ($conexion->getTotalFilas()>0){
        //si es valido accedemos a ingreso.php
        session_start();
        $_SESSION['usuario']=$usuario;
        header('Location:ingreso.php?mensaje=bienvenido');
    } else {
        //si no es valido volvemos al formulario inicial
        header('Location: index.html?mensaje=error_login');
    }


?>