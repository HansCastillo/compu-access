<?php

include 'conexion.php';

$codigo=$_POST['codigo'];
$nombre=$_POST['nombre'];
$cantidad=$_POST['cantidad'];
$precio=$_POST['precio'];

try{
  
        $sql1="insert into productos(id,codigo,nombre,precio) values('0','$codigo','$nombre','$precio');";
		$con->exec($sql1);
 
    header("location:prod_registro.php");
}
catch(Exception $e){
	echo "ERROR:".$e->getMessage();
}
?>