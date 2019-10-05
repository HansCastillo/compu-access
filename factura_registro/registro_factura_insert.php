<?php

//header("content-type: application/x-www-form-urlencoded");

include 'conexion.php';

$cod=$_GET['cod'];
$cliente=$_GET['cliente'];
$producto=$_GET['producto'];
$cant=$_GET['cant'];


echo $cod;


try{
        $sql1="insert into facturas(id,codigo,cliente,productocod,cantidad) values('0','$cod','$cliente','$producto','$cant');";        
        if($con->exec($sql1)>=1){

        }
        else{

        }
        
    
   //header("location:user_registrar.php?mensaje=$mens");
}
catch(Exception $e){
    echo "ERROR:".$e->getMessage();
}
?>