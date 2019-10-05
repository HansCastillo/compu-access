<?php
include '../session_conexion/conexion.php';

$resultado=array();

try{
    $sql="select id,usuario,password,nombre,apellido,correo from usuarios";
    $statement=$con->query($sql);
    
    while($fila=$statement->fetch(PDO::FETCH_ASSOC)){        
        $resultado[]=$fila;
    }
    $resultado=json_encode($resultado);       
}
catch(Exception $e){
    echo "ERROR:".$e->getMessage();
}

?>