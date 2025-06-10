<?php
    require_once "config/conexion.php";
    class LoginController{
        public static function index(){
            require "vista/front/formLogin.php";
        }
        public static function auth(){
            if($_SERVER['REQUEST_METOD']==='POST'){
                $conexion = (new Conexion())->conectar();
                $usuario = $_POST['txtUsuario'] ?? '';
                $contraseña = $_POST['txtContraseña'] ?? '';

                if(empty($usuario) || empty($contraseña)){
                    header("Location: ".urlsite."?page=login&msg=El usuario y contraseña son necesarios.");
                    exit;
                }
                $consulta = $conexion->prepare("SELECT*FROM login WHERE usuario = ?");
                $consulta->execute([$usuario]);
                $user = $consulta->fetch();
                if($user && password_verify($contraseña, $user['password'])){
                    session_start();
                    $_SESSION['user'] = $user;
                    header("Location: ".urlsite."?page=inicio");
                }else{
                    header("Location: ".urlsite."?page=login&msg=Credenciales incorrectas!");
                }

            }
        }
    }
?>