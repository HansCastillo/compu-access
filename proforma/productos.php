<?php
    include "../session_conexion/conexion.php";        

    $valor=$_GET["val"];    
    $resultado=[];

        $sql="select codigo,nombre,precio from productos2 where nombre like '%$valor%' or codigo like '%$valor%'; ";
        $statement=$con->query($sql);
        while($fila=$statement->fetch(PDO::FETCH_ASSOC)){
            $resultado[]=$fila;
        }        
        echo json_encode($resultado);

?>