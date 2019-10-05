<?php

    session_start();    
    include '../session_conexion/conexion.php';    
    include '../session_conexion/session_verif.php';    

    $id_usuario = $_SESSION["id"];    
    $sesion=new ManejadorDeSession($con);
    $sesion->confirmar($id_usuario);    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <link href="https://fonts.googleapis.com/css?family=Dosis:300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/barra_menu.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/contenido_menu.css" />   
    
</head>
<body>
<div class='contenedor-barra-usuario'>
    <div class="centrar"><?php echo $sesion->getNombreUsuario()?></div>
    <div class="centrar">        
        <div class="imagen-usuario">
            <img src="../session_conexion/imagen_usuario.php?id=<?php echo $id_usuario?>" alt="sin" >
        </div>    
    </div>
    <div class="centrar">
        <a id="enlace_salir" href="../session_conexion/cerrar_session.php">
            <img src="../imagenes/cerrar_session.png" alt="cerrar">
        </a>
    </div>
</div>

<div class="contenido">
    <div class="list centrar"><!--<a class="" href="../producto_registro/prod_registro.php">Registro de producto</a>--><div class="rombo"></div></div>
    <div class="list centrar"><!--<a class="" href="../factura_registro/registro_factura.php">Registro de Factura</a>--><div class="rombo"></div></div>
    <div class="list centrar"><!--<a class="" href="../factura_registro/factura_consulta.php">Consulta de Factura</a>--><div class="rombo"></div></div>
    <div class="list centrar"><a class="" href="../usuario_consulta/user_consulta.php">Consulta y Edicion de Usuarios</a><div class="rombo"></div></div>
    <div class="list centrar"><a class="" href="../usuario_registro/user_registrar.php">Ingreso de Nuevo Usuario</a><div class="rombo"></div></div>
    <div class="list centrar"><a class="" href="../proforma/listaproductos.html">Proforma</a><div class="rombo"></div></div>
</div>   
</body>
<script>         
</script>
</html>