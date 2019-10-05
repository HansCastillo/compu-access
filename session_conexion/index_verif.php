<?php

include 'conexion.php';

class IndexVerif{
    private $conexion;
    function __construct($conexion){
        $this->conexion = $conexion;
    }
    public function verificarUsuario( $usu, $pass){
        try{
            $sql="select id,usuario,password from usuarios where usuario='$usu'";
            $statement=$this->conexion->query($sql);
            $fila=$statement->fetch(PDO::FETCH_ASSOC);          
            if(!$fila){
                return "desconocido";
            }
            else{        
                if($fila["password"]===$pass){      
                    session_start();                    
                    $_SESSION["id"] = $fila["id"];
                    return "identificado";
                }
                else{
                    return "incorrecto_pass";
                }
            }    
            
            }
        catch(Exception $e){
            //return "error: ".$e->getMessage();
        }       
    } 
}

$usuario=$_POST['usu'];
$password=$_POST['pas'];
$identificador = new IndexVerif($con);
echo $identificador-> verificarUsuario( $usuario, $password );

?>  