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
    <title>Registrar Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/barra_menu.css" />
    <link href="https://fonts.googleapis.com/css?family=Dosis:300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <script src="main.js"></script>   
    <style>
        body{
            background-color:#b0b5ff;            
        }
        #contenedor-formulario{                        
            display:flex;
            flex-wrap:wrap;                        
            justify-content:center;
            align-items:center;            
        }
        .marco-imagen{
            width:300px;
            height:300px;
            background:slateGrey;        
            position:relative;
            margin-top:20px;
        }
        #formulario{
            margin-top:20px;
            width: 500px;            

            display:grid;
            grid-template-columns: 100px 300px;
            grid-auto-rows:50px;            
            justify-content:center;
        }        
        #formulario>div{
            display:flex;
            align-items: center;
        }
        #formulario>input{
            margin:3px;
            padding-left:10px;
            border-radius: 10px;
            border:none;
        }        
        #formulario #submit{
            padding-left:0px;
            margin-top:10px;
        }
        #formulario input[type="file"]{
            display:none;           
        }
        .boton{
            border-radius:5px;
            padding:5px;
            background-color:black;
            color:white;
            cursor:pointer;    
        }        
        #usu_foto{
            width:300px;
            height:300px;            
        }
        .centrar1{
            position:absolute;            
            width:50%;
		    top:calc(50% - (1.2em + 10px ) );
            left:25%;            
            font-size:1.2em;
		    border: dotted 2px white;
            padding:20px;
            color:white;
        }
        @media screen and (max-width:450px){
            #formulario{
                grid-template-columns:250px;
                grid-auto-rows:35px;            
            }
            .marco-imagen{
                width:250px;
                height:250px;                
            }
            #usu_foto{
                width:250px;
                height:250px;
            }
	    }
    </style>
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
    <div class='contenedor-menu'>
        <div id="e1"><a href="../menu/menu.php">Menu</a></div>
        <div id="e2"><a href="../usuario_consulta/user_consulta.php">Consulta de Usuarios</a></div>
        
    </div>
    <div id="contenedor-formulario">
        <form id="formulario" action="user_registrar_insert.php" method="post" enctype="multipart/form-data">           
            <div>Usuario</div>
            <input type="text" name="usuario" id="usuario" required>
            <div>Contraseña</div>
            <input type="text" name="password" id="password" required>
            <div>Nombre</div>
            <input type="text" name="nombre" id="nombre" required>
            <div>Apellido</div>
            <input type="text" name="apellido" id="apellido" required>
            <div>Correo</div>
            <input type="text" name="correo" id="correo">
            <input type="file" name="archivo" id="archivo">
            <div id="selecionador_archivo">
                <div class="boton">Seleccionar Foto</div>
            </div>
            <input type="submit" name="submit" id="submit" value="REGISTRAR"> 
            
        </form>        
        <div class="marco-imagen">
            <!--<div class="mensaje-aqui centrar1">Arratrar foto Aquí</div>-->
            <img src="" alt="" id="usu_foto">            
        </div>
    </div>    
    <script>                
        let mensaje='<?php echo $_GET["mensaje"]; ?>';        
        if(mensaje!=''){            
            alert(mensaje);
            window.location.replace('user_registrar.php'); 
        }          
         
        selecionador_archivo.onclick=function(evt){            
            archivo.click();                                    
        }        
        archivo.addEventListener("change",obtenerFiles,false);
        function obtenerFiles(){            
            var urlCreator = window.URL || window.webkitURL;
            var imageUrl = urlCreator.createObjectURL(this.files[0]);
            document.querySelector("#usu_foto").src = imageUrl;
        }
        
    </script>
</body>    
</html>