<?php 

	#Archivo de conexion a la BD de estaciones metereologicas

	$user = "root";
	$pass = "";
	$host = "localhost";
	$bd   = "estacion_m";

    $conexion = new mysqli($host, $user, $pass, $bd);

    if($conexion->connect_error) {
    	echo "Error conectando a la BD: " . $conexion->connect_error . "<br />";
    }
 ?>