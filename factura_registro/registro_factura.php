<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registro de Factura</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="barra_menu.css" />
    <script src="main.js"></script>
    <style>
        table{font-size:14px;}
        #tabla input[name='codigo']{width:70px;}
        #tabla input[name='precio']{width:50px;}        
        #tabla2 td{border:solid 1px grey;}
        #tabla2 td:nth-child(2){width:130px;} 
        h4{padding:20px 100px;}
        #item2{ position:relative;}
        #tabla3 {
            position:absolute;
            left:250px;
        }
        #contenedor{
            display:grid;
            grid-template-columns:50% 50%;
        }    

    </style>
</head>
<body>
    
    <div id='contenedor-menu'>
        <div id="e1"><a href="menu.php">Menu</a></div>	
        
        <div id="e2"><a href="factura_consulta.php">Consulta de Factura</a></div>        
        <div id="e3"><a href="index.php">SALIR</a></div>
    </div>
    <div id='contenedor'>
        <div id="item1">
            <h4>LISTA DE PRODUCTOS</h4>    
            <table id="tabla">
            </table>
        </div>
        <div id="item2">
        <h4>REGISTRO DE FACTURA</h4>    
            <table id="tabla2">
            </table>
            <table id="tabla3">
            </table>
           <p> <input type="button" value="GUARDAR" onclick="enviardatos()"></p>
            <br>
           <p> <input type="text" id="codigof" name="codigof" readonly ></p>
            <br>
            <input type="text" id="cliente" name="cliente" placeholder="cliente">
        </div>    
    </div>
    <script>
        <?php include 'registro_factura_select.php';?>
        let sql=<?php echo $resultado; ?>;               
        let headers=["codigo","nombre","precio","cant"];
        
        insertarCabecerasH(tabla,headers,0);        
        let ary=crearTabla(tabla,sql.length,headers.length-1);                                
        insertarModificadores(tabla,1);
        asociarDatos(ary,sql);
        cargaInicial();
        cargarUltimoCodigo();

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
            let modificador1='<select name="cantidad">';
            for(let x=1;x<10;x++){
		 	    modificador1+='<option value="'+x+'">'+x+'</option>';				
            }
		    modificador1+='</select>';            
            let modificador2="<button class='bSeleccionar' onclick='btnAgregar(this)'>AGREGAR</button>";            
            let i=0;
            if(espacio==1){i=1;}
            for(i;i<filas;i++){
                tb.rows[i].insertCell(-1).innerHTML=modificador1;
                tb.rows[i].insertCell(-1).innerHTML=modificador2;
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
        function btnAgregar(btn){
            /*funcion1*/
            let cod;
            let nom;
            let pre;
            let cant;
            let fila=btn.parentNode.parentNode;            
            for(let c of fila.cells){
                if(c.firstChild.nodeName=='INPUT'||c.firstChild.nodeName=='SELECT'){                    
                    if(c.firstChild.getAttribute("name")=="codigo"){cod=c.firstChild.value;}                    
                    if(c.firstChild.getAttribute("name")=="nombre"){nom=c.firstChild.value;}
                    if(c.firstChild.getAttribute("name")=="precio"){pre=c.firstChild.value;}
                    if(c.firstChild.getAttribute("name")=="cantidad"){cant=c.firstChild.value;}
                }
            }
            
            /*funcion1-fin*/
            
            /*funcion2*/
            let filaInsertada=tabla2.insertRow(1);    
            filaInsertada.insertCell().innerHTML=cod;            
            filaInsertada.insertCell().innerHTML=nom;            
            filaInsertada.insertCell().innerHTML=pre;            
            filaInsertada.insertCell().innerHTML=cant;
            filaInsertada.insertCell().innerHTML=(cant*pre);                        
            
            tabla3.rows[0].cells[1].innerHTML=calcularTotal();
            /*funcion2-fin*/
           
            
        }
        
        function cargaInicial(){
            let headers=["codigo","nombre","precio","cantidad","subtotal"];
            insertarCabecerasH(tabla2,headers,0);  
            let filaInsertada2=tabla3.insertRow();
            filaInsertada2.insertCell().innerHTML="<h5>TOTAL</h5>";            
            filaInsertada2.insertCell().innerHTML=calcularTotal();               
        }
        function calcularTotal(){
            let filas=tabla2.rows;
            let total=0;
            for(let f=1;f<filas.length;f++){
                total+=parseFloat(filas[f].cells[4].innerHTML);
            }
            return total;
        }         

        function cargarUltimoCodigo(){            
            var xhr1 = new XMLHttpRequest();
            xhr1.open("GET", "factura_consulta_select.php?n=4",true); 						            
            xhr1.responseType = "text";
            xhr1.onload =function(){ 
                let datos=JSON.parse(this.response); 
                codigof.value=parseInt(datos[0]["codigo"])+1;
            }
            xhr1.send();
        }
        


        function enviardatos(){
            if(codigof.value==""||cliente.value==""){
                alert("Ingrese nombre del cliente");
            }
            else{                

                let filas=tabla2.rows;
                if(filas.length>1){ 
                    for(let f=1;f<filas.length;f++){
                        
                        let celdas=filas[f].cells;
                        let parametros="?";
                        parametros+="cod="+codigof.value;
                        parametros+="&cliente="+cliente.value;
                        parametros+="&producto="+celdas[0].innerHTML;
                        parametros+="&cant="+celdas[3].innerHTML;
                        
                        var xhr = new XMLHttpRequest();
                        xhr.open("GET", "registro_factura_insert.php"+parametros,true); 						            
                        xhr.responseType = "text";
                        xhr.onload =function(){ 
                        }
                        xhr.send();
                    }
                }           
                window.location.replace('registro_factura.php');
            }
            
        }

    </script>
</body>
</html>