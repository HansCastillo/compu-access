<?php
session_start();    
include '../session_conexion/conexion.php';    
include '../session_conexion/session_verif.php';    

$id_usuario = $_SESSION["id"];    
$sesion=new ManejadorDeSession($con);
$sesion->confirmar($id_usuario);    


$id=$_POST['id'];
try{
    if($id==24){
        header("location:user_consulta.php?mensaje=3");   
    }
    else{
        $sql="delete from usuarios where id='$id'";    
        $filasAfectadas=$con->exec($sql);
        if($filasAfectadas==0){
            header("location:user_consulta.php?mensaje=3");   
        }
        else{
            header("location:user_consulta.php?mensaje=4");                
        }
    }
}
catch(Exception $e){
    echo "ERROR:".$e->getMessage();
}

?>