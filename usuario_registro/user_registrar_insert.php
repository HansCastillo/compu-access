<?php

session_start();    
include '../session_conexion/conexion.php';    
include '../session_conexion/session_verif.php';    

$id_usuario = $_SESSION["id"];    
$sesion=new ManejadorDeSession($con);
$sesion->confirmar($id_usuario);    


$usuario=$_POST['usuario'];
$password=$_POST['password'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$correo=$_POST['correo'];

try{
    $mens='';    

    $fileOpen = fopen( $_FILES['archivo']["tmp_name"] , "r" );
    $contenido = fread( $fileOpen , $_FILES["archivo"]["size"] );
    fclose($fileOpen);
    $imagenblob = addslashes($contenido);

    $sql="select usuario from usuarios where usuario='$usuario'";
    $statement=$con->query($sql);
    $fila=$statement->fetch(PDO::FETCH_ASSOC);    
    if($fila){
        echo $mens="El USUARIO YA EXISTE";
    }
    else{
        $sql1="insert into usuarios(usuario,password,nombre,apellido,correo,imagen) values('$usuario','$password','$nombre','$apellido','$correo','$imagenblob');";        
        if($con->exec($sql1)>=1){
            echo $mens="USUARIO REGISTRADO EXITOSAMENTE";
        }
        else{
            echo $mens="NO SE PUDO REGISTRAR AL USUARIO";
        }
        
    }
    header("location:user_registrar.php?mensaje=$mens");
}
catch(Exception $e){
    echo "ERROR:".$e->getMessage();
}
?>