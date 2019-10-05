<?php
session_start();    
include '../session_conexion/conexion.php';    
include '../session_conexion/session_verif.php';    

$id_usuario = $_SESSION["id"];    
$sesion=new ManejadorDeSession($con);
$sesion->confirmar($id_usuario);  

$valor=$_GET["id"];        
    
    header("Content-type:image");        
    $sql="select imagen from usuarios where id='$valor'; ";    
    $statement=$con->query($sql);
    $fila=$statement->fetch(PDO::FETCH_ASSOC);     
    echo $fila["imagen"];   

?>