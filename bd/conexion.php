<?php 
class Conexion{	  
    public static function Conectar() {        
        define('servidor', 'bxsisv25jwhyju0ft6kg-mysql.services.clever-cloud.com');
        define('nombre_bd', 'bxsisv25jwhyju0ft6kg');
        define('usuario', 'uxlfrymf0w8xl6uo');
        define('password', 'LyXn7j2iCs1uJ0K3Wgif');					        
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');			
        try{
            $conexion = new PDO("mysql:host=".servidor."; dbname=".nombre_bd, usuario, password, $opciones);			
            return $conexion;
        }catch (Exception $e){
            die("El error de Conexión es: ". $e->getMessage());
        }
    }
}