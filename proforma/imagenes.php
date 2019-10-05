<?php

    include "../session_conexion/conexion.php";  

    $valor=$_GET["img"];        

        //header("Content-type:img");        
        $sql="select imagen from productos2 where codigo='$valor'; ";
        $statement=$con->query($sql);
        $fila=$statement->fetch(PDO::FETCH_ASSOC); 
        echo $fila["imagen"];

?>