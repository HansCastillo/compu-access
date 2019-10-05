
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
    <title>Consulta usuarios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/barra_menu.css" />    
    <title>Hello, world!</title>
  </head>
  <body>       
    <style>        
        #tabla{            
            font-size:12px;
        }
        #tabla td{            
            padding:2px;
        }
        #tabla td input[type="text"]{            
            width:100px;
        }
        .contenedor-tabla{
            width:100%;
            overflow-x:scroll;
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
        <div id="e2"><a href="../usuario_registro/user_registrar.php">Ingresar nuevo Usuario</a></div>
        
    </div>
    <div class="contenedor-tabla">
        <table id="tabla" class="table table-hover">        
        </table>
    </div>    
    <form id="formularioUpdate" action="user_consulta_update.php" method="post">                      
    </form>         
    <form id="formularioDelete" action="user_consulta_delete.php" method="post">                      
    </form>         
    <script>
        
        function crearTabla(tb,filas,columnas){                                                            
            let referenciaCeldas=[];            //crear array referenciaCeldas
            for(let f=0;f<filas;f++){                
                referenciaCeldas.push([]);      //un array vacio es añadido como ultimo elemento de referenciaCeldas
                let row=tb.insertRow(-1);       //inserta fila en la tabla       
                for(let c=0;c<columnas;c++){    
                    let cell=row.insertCell(-1);    //insertar celda a la fila               
                    referenciaCeldas[f].push(cell);  //almacenar referencia de la celda dentro del    
                }                                   //array q esta dentro de referenciaCeldas
            }
            return referenciaCeldas;
        }
        
        function insertarCabecerasH(tb,ar,espacio){
              let fila=tb.insertRow(0);        
              if(espacio==1){fila.insertAdjacentHTML("beforeend","<th></th>")}
              for( let e of ar){
                  fila.insertAdjacentHTML("beforeend","<th>"+e+"</th>");
              }
        }
        function insertarCabecerasV(tb,ar,espacio){            
            let i=0;
            if(espacio==1){i=1;}
            for(let e of ar){
                tb.rows[i].insertCell(0).innerHTML=e;
                i++;
            }
        }
        function insertarModificadores(tb,espacio){
            let filas=tb.rows.length;
            let modificador1="<button class='bEditar' onclick='btnEditar(this)'>EDITAR</button>";
            let modificador2="<button class='bEliminar' onclick='btnEliminar(this)'>ELIMINAR</button>";
            let modificador3="<button class='bAceptar' onclick='btnAceptar(this)'>ACEPTAR</button>";
            let modificador4="<button class='bCancelar' onclick='btnCancelar(this)'>CANCELAR</button>";
            let i=0;
            if(espacio==1){i=1;}
            for(i;i<filas;i++){
                tb.rows[i].insertCell(-1).innerHTML=modificador1;
                tb.rows[i].insertCell(-1).innerHTML=modificador2;
                tb.rows[i].insertCell(-1).innerHTML=modificador3;
                tb.rows[i].insertCell(-1).innerHTML=modificador4;
            }
        }        
        function  btnEditar(btn){
            let fila=btn.parentNode.parentNode;                                   
            disabledRowInput(false,fila);
            disabledAllEditarEliminar(true);
            disabledRowAceptarCancelar(false,fila);            
            addFormulario(fila,"formularioUpdate");    
        }
        function btnAceptar(btn){
            formularioUpdate.submit();            
        }
        function btnCancelar(btn){
            let fila=btn.parentNode.parentNode;     
            asociarDatos(ary,sql);
            cargaInicial();
            disabledAllEditarEliminar(false);
            addFormulario(fila,""); 
        } 
        function btnEliminar(btn){
            let fila=btn.parentNode.parentNode;                                   
            addFormulario(fila,"formularioDelete");  
            formularioDelete.submit();    
        }               
        //Añade el atributo form a los elementos input q se encuentran en su misma fila 
        function addFormulario(fila,idForm){                        
            let celdas=fila.cells;            
            for(let c of celdas){                                
                if(c.firstChild.nodeName=="INPUT"){                    
                    c.firstChild.setAttribute("form",idForm);                      
                }
            }
            
        }
                                     
        function disabledAllInput(x){
            let filas=tabla.rows;                        
            for(let r=1;r<filas.length;r++){                  
                let celdas=filas[r].cells;                   
                for(let c of celdas){                                                            
                    if(c.firstChild.nodeName=="INPUT"&& c.firstChild.getAttribute('name')!='id'){                                    
                        if(x==true){ c.firstChild.setAttribute("disabled","");}
                        else{c.firstChild.removeAttribute("disabled");}                                               
                    }                                                           
                }    
            }                        
        }    
        function disabledAllAceptarCancelar(x){
            let filas=tabla.rows;                        
            for(let r=1;r<filas.length;r++){                  
                let celdas=filas[r].cells;                         
                for(let c of celdas){                                                                                
                    if(c.firstChild.className=="bCancelar"||c.firstChild.className=="bAceptar"){                                    
                        if(x==true){ c.firstChild.setAttribute("disabled","");}
                        else{c.firstChild.removeAttribute("disabled");}                                               
                    }                                                           
                }    
            }
        }
        function disabledAllEditarEliminar(x){
            let filas=tabla.rows;                        
            for(let r=1;r<filas.length;r++){                  
                let celdas=filas[r].cells;                         
                for(let c of celdas){                                                                                
                    if(c.firstChild.className=="bEditar"||c.firstChild.className=="bEliminar"){                                    
                        if(x==true){ c.firstChild.setAttribute("disabled","");}
                        else{c.firstChild.removeAttribute("disabled");}                                               
                    }                                                           
                }    
            }
        }   
        function disabledRowInput(x,fila){
            let celdas=fila.cells;                         
                for(let c of celdas){                                                                                
                    if(c.firstChild.nodeName=="INPUT"&& c.firstChild.getAttribute('name')!='id'){                                    
                        if(x==true){ c.firstChild.setAttribute("disabled","");}
                        else{c.firstChild.removeAttribute("disabled");}                                               
                    }                                                           
                }
        }
        function disabledRowAceptarCancelar(x,fila){
            let celdas=fila.cells;                         
                for(let c of celdas){                                                                                
                    if(c.firstChild.className=="bCancelar"||c.firstChild.className=="bAceptar"){                                    
                        if(x==true){ c.firstChild.setAttribute("disabled","");}
                        else{c.firstChild.removeAttribute("disabled");}                                               
                    }                                                           
                }
        }
        function disabledAllId(x){
            let filas=tabla.rows;                        
            for(let r=1;r<filas.length;r++){                  
                let celdas=filas[r].cells;                         
                for(let c of celdas){                                                                                
                    if(c.firstChild.getAttribute('name')=='id'){
                        if(x==true){ c.firstChild.setAttribute("readonly","");}
                        else{c.firstChild.removeAttribute("readonly");}                                               
                    }                                                           
                }    
            }
        }         
        function asociarDatos(arCeldas,arObject){
            for(let f=0;f<arCeldas.length;f++){
                let c=0;
                for(let p in arObject[f]){                     
                    arCeldas[f][c].innerHTML="<input type='text' value='"+arObject[f][p]+"' name='"+p+"'>";
                    c++;
                }
            }
        }        
        function cargaInicial(){
            disabledAllInput(true);
            disabledAllAceptarCancelar(true);
            disabledAllId(true);
        }        
        <?php
            if($_GET['mensaje']==1){
                echo "alert('No se pudo actualizar el registro del Usuario')";
            }
            if($_GET['mensaje']==2){
                echo "alert('Registro de Usuario Actualizado')";
            }
            if($_GET['mensaje']==3){
                echo "alert('No se pudo eliminar Al Usuario')";
            }
            if($_GET['mensaje']==4){
                echo "alert('Usuario Eliminado')";
            }
        ?>
        
        <?php include 'user_consulta_select.php';?>
        let sql=<?php echo $resultado; ?>;        
          
        let headers=["id","usuario","password","nombre","apellido","correo"];
       
        insertarCabecerasH(tabla,headers,0);
        
        let ary=crearTabla(tabla,sql.length,headers.length);                                
        insertarModificadores(tabla,1);
        asociarDatos(ary,sql);
        cargaInicial();      
        

       
    
    </script>   
    
</body>
</html>