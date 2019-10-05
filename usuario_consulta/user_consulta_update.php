<?php
session_start();    
include '../session_conexion/conexion.php';    
include '../session_conexion/session_verif.php';    

$id_usuario = $_SESSION["id"];    
$sesion=new ManejadorDeSession($con);
$sesion->confirmar($id_usuario);    


$id=$_POST['id'];
$usuario=$_POST['usuario'];
$password=$_POST['password'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$correo=$_POST['correo'];
echo $id;

if($id==24){
    header("location:user_consulta.php?mensaje=1");   
}
else{
try{
        $sql="update usuarios set usuario='$usuario', password='$password', nombre='$nombre',
         apellido='$apellido', correo='$correo' where id='$id'; ";
        $filasAfectadas=$con->exec($sql);
        if($filasAfectadas==0){
            header("location:user_consulta.php?mensaje=1");        
            //echo "No se pudo Actualizar usuario";
        }
        else{
            header("location:user_consulta.php?mensaje=2");        
            //echo "Usuario Actualizado";
        }

    }
    catch(Exception $e){
        echo "ERROR:".$e->getMessage();
    }
}

?>