<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Consulta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="barra_menu.css" />
    <script src="main.js"></script>
    <style>
        #tabla th,td{
            padding:5px;
        }
    </style>
</head>
<body>
    <div id='contenedor-menu'>
        <div id="e1"><a href="menu.php">MENU</a></div>        
        <div id="e3"><a href="index.php">SALIR</a></div>
    </div>
    <br>
    CODIGO DE FACTURA:
    <select name="lista_codigo" id="lista_codigo" onchange="eventoSelect()">               
    </select>
    <br><br>
    CLIENTE:
    <input type="text" name="cliente" id="cliente">     
    FECHA:
    <input type="text" name="fecha" id="fecha">     
    <br>
    <br>
    <table id="tabla1">
     </table>  
    <table id="tabla2">
    </table>  
    <table id="tabla3">
        <tr><th>TOTAL:</th><td id="celdaTotal"></td></tr>
    </table>   
</body>
    <script>
        cargarSelect();        
        cargarTabla();
        cargarCliente();
        function eventoSelect(){
            cargarTabla();
            cargarCliente();
        }
        function cargarSelect(){            
            var xhr = new XMLHttpRequest();
            xhr.open("GET","factura_consulta_select.php?n=1",true); 						            
            xhr.responseType = "text";
            xhr.onload =function(){ 
                let datos=JSON.parse(this.response); 
                for(let fila of datos){                    
                    lista_codigo.insertAdjacentHTML("beforeend","<option value='"+fila.codigo+"'>"+fila.codigo+"</option>");
                }
            }
            xhr.send();            
        }
        function cargarTabla(){
            tabla1.innerHTML="<tr><th>codigo</th><th>nombre</th><th>precio</th><th>cantidad</th><th>subtotal</th></tr>";
            var xhr = new XMLHttpRequest();
            xhr.open("GET","factura_consulta_select.php?n=2&c="+lista_codigo.value,true); 						            
            xhr.responseType = "text";
            xhr.onload =function(){ 
                let datos=JSON.parse(this.response); 
                let total=0;
                for(let objeto of datos){                    
                    let fila=tabla1.insertRow();
                    fila.insertCell().innerHTML=objeto["productocod"];    
                    fila.insertCell().innerHTML=objeto["nombre"];    
                    fila.insertCell().innerHTML=objeto["precio"];    
                    fila.insertCell().innerHTML=objeto["cantidad"];    
                    total+=objeto["precio"]*objeto["cantidad"];
                    fila.insertCell().innerHTML=objeto["precio"]*objeto["cantidad"];
                }
                celdaTotal.innerHTML=total;
                                
            }
            xhr.send();
        }
        function cargarCliente(){            
            var xhr = new XMLHttpRequest();
            xhr.open("GET","factura_consulta_select.php?n=3&c="+lista_codigo.value,true); 						            
            xhr.responseType = "text";
            xhr.onload =function(){ 
                let datos=JSON.parse(this.response); 
                cliente.value=datos[0]["cliente"];
                fecha.value=datos[0]["fecha"];
            }
            xhr.send();            
        }
    </script>
</html>