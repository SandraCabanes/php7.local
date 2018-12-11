<?php
require_once 'utils/utils.php'; //validar la opción de menú activa
//require_once 'exceptions/FileException.php';
require_once 'utils/File.php';
require_once 'entity/ImagenGaleria.php';
require_once 'database/Connection.php';
require_once 'database/QueryBuilder.php';
require_once 'core/App.php';

$errores=[];
$descripcion='';
$mensaje='';
$config=require_once 'app/config.php';
App::bind('config', $config); //Añadir en el array container de App.php el elemento config

$connection=App::getConnection();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
   try{
       $descripcion=trim(htmlspecialchars($_POST['descripcion']));
       $tiposAcertados=['image/jpeg', 'image/png', 'image.gif'];

       $imagen=new File('imagen', $tiposAcertados);
       $imagen->saveUploadFile(ImagenGaleria::RUTA_IMAGENES_GALLERY);
       $imagen->copyFile(ImagenGaleria::RUTA_IMAGENES_GALLERY, ImagenGaleria::RUTA_IMAGENES_PORTFOLIO);


       $sql="INSERT INTO imagenes(nombre, descripcion) VALUES(:nombre, :descripcion)";

       //'". $imagen->getFileName(). "', '$descripcion'

       $pdoStatement=$connection->prepare($sql);
       $parameters=[
           ':nombre'=>$imagen->getFileName(),
           ':descripcion'=>$descripcion
       ];

       if($pdoStatement->execute($parameters)===false)
           $errores[]="No se ha podido guardar la imagen en la BDA";
       else {
           $mensaje = 'Se ha guardado la imagen';
           $descripcion = '';
       }

       $mensaje='Se ha guardado la imagen';
   }catch (FileException $fileException){
       $errores[]=$fileException->getMessage();
   }

}

$queryBuilder=new QueryBuilder();
$imagenes=$queryBuilder->findAll('imagenes', 'ImagenGaleria');

require 'views/galeria.view.php';