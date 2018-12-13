<?php
require_once __DIR__ . '/../utils/utils.php'; //validar la opción de menú activa
require_once __DIR__ . '/../exceptions/FileException.php';
require_once __DIR__ . '/../exceptions/QueryException.php';
require_once __DIR__ . '/../utils/File.php';
require_once __DIR__ . '/../repository/ImagenGaleriaRepository.php';
require_once __DIR__ . '/../entity/ImagenGaleria.php';
require_once __DIR__ . '/../database/Connection.php';
require_once __DIR__ . '/../database/QueryBuilder.php';
require_once __DIR__ . '/../core/App.php';


$errores = [];
$descripcion = '';
$mensaje = '';

try {
    $config = require_once '../app/config.php';
    App::bind('config', $config); //Añadir en el array container de App.php el elemento config

    $imagenGaleriaRepository = new ImagenGaleriaRepository();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $descripcion = trim(htmlspecialchars($_POST['descripcion']));
        $tiposAcertados = ['image/jpeg', 'image/png', 'image.gif'];

        $imagen = new File('imagen', $tiposAcertados);
        $imagen->saveUploadFile(ImagenGaleria::RUTA_IMAGENES_GALLERY);
        $imagen->copyFile(ImagenGaleria::RUTA_IMAGENES_GALLERY, ImagenGaleria::RUTA_IMAGENES_PORTFOLIO);


        $imagenGaleria = new ImagenGaleria($imagen->getFileName(), $descripcion);
        $imagenGaleriaRepository->save($imagenGaleria);

        $mensaje = 'Se ha guardado la imagen';
        $descripcion = '';
    }
    $imagenes = $imagenGaleriaRepository->findAll();
} catch (QueryException $exception) {
    throw new QueryException("Error de base de datos");
} catch (FileException $e) {
    throw new FileException("Error en el fichero");
}

require '../views/galeria.view.php';