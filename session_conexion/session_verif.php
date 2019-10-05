<?php
    

/*Este clase contendra un metodo para verificar la sesion*/

    class ManejadorDeSession{        
        private $conexion;
        private $nombreUsuario;
        function __construct ($conexion) {            
            $this->conexion = $conexion;    
        }

        public function confirmar($idUsuario){
        try{
            if ($idUsuario!==null){                
                $sentencia = "select nombre,apellido from usuarios where id='".$idUsuario."'";                
                $registro = $this->conexion->query($sentencia);                                    
                $row = $registro->fetch(PDO::FETCH_ASSOC);
                if( $row != false ){
                    $this->nombreUsuario = $row["nombre"]." ".$row["apellido"];                                                    
                }
                else{            
                    header("location:../index.html");    
                }                
            }    
            else{                
                header("location:../index.html");
             }
        }
        catch(Exception $e){ echo "error: ".$e->getMessage(); }
        }
        public function getNombreUsuario(){
            return $this->nombreUsuario;
        }             
        
    }

?>