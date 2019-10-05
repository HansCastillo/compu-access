<?php
include 'conexion.php';

$resultado=array();

try{
    $sql="select codigo,nombre,precio from productos";
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