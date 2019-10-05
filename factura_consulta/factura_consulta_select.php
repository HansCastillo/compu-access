<?php
    include 'conexion.php';
    
    $resultado=array();
    $sql="";   
    if($_GET["n"]=="2"){
        $sql='select facturas.productocod,productos.nombre,productos.precio,facturas.cantidad
         FROM facturas inner join productos on facturas.productocod=productos.codigo
         where facturas.codigo="'.$_GET['c'].'";';
    }
    if($_GET["n"]=="1"){
        $sql="select codigo from facturas GROUP BY codigo;";
    }
    if($_GET["n"]=="3"){
        $sql="select cliente,fecha from facturas GROUP BY codigo
         having facturas.codigo='".$_GET['c']."';";
    }
    if($_GET["n"]=="4"){
        $sql="select codigo from facturas order by fecha desc limit 0,1;";
    }
    
    try{        
        $statement=$con->query($sql);
        
        while($fila=$statement->fetch(PDO::FETCH_ASSOC)){        
            $resultado[]=$fila;
        }
        $resultado=json_encode($resultado);   
        echo $resultado;
    }
    catch(Exception $e){
        echo "ERROR:".$e->getMessage();
    }
    
?>