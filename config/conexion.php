<?php
    class Conexion{
        public $conexion;
        public function conectar(){
            try{
                $dsn="mysql:locallhost; dbname=".DB_NAME."; charset=utf8";
                $opciones = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ];
                $this->$conexion = new PDO($dsn, DB_USER, DB_PASSWORD, $opciones);
                return$this->$conexion;
            }catch(PDOException $e){
                die("Error de conexion a la Base de Datos.".$e->getMessage());
            }
        }

        public function desconectar(){
            $this->$conexion = null;
        }
    }
?>