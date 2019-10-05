<?php
    $con;
    try{
        $con=new PDO("mysql:host=localhost;dbname=telesup","root","47655232");
        //$con ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);        
    }
    catch(Exception $e){
        echo "Conexion fallida".$e->getMessage();        
    }

?>