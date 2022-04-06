<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$TITULO = (isset($_POST['TITULO'])) ? $_POST['TITULO'] : '';
$IMAGEN = (isset($_POST['IMAGEN'])) ? $_POST['IMAGEN'] : '';
$DESCRIPCION = (isset($_POST['DESCRIPCION'])) ? $_POST['DESCRIPCION'] : '';
$AUTOR = (isset($_POST['AUTOR'])) ? $_POST['AUTOR'] : '';
$FECHA = (isset($_POST['FECHA'])) ? $_POST['FECHA'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$ID = (isset($_POST['ID'])) ? $_POST['ID'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO CardBlog (TITULO, IMAGEN, DESCRIPCION, AUTOR, FECHA) VALUES('$TITULO', '$IMAGEN', '$DESCRIPCION', '$AUTOR', '$FECHA') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM CardBlog ORDER BY ID DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE CardBlog SET TITULO='$TITULO', IMAGEN='$IMAGEN', DESCRIPCION='$DESCRIPCION', AUTOR='$AUTOR', FECHA='$FECHA' WHERE ID='$ID' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM CardBlog WHERE ID='$ID' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM CardBlog WHERE ID='$ID' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM CardBlog";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;