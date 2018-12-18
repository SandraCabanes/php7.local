<?php
require_once __DIR__ . '/../utils/utils.php';
require_once __DIR__ . '/../utils/File.php';
require_once __DIR__ . '/../entity/Contacto.php';
require_once __DIR__ . '/../database/Connection.php';
require_once __DIR__ . '/../repository/ContactosRepository.php';
require_once __DIR__ . '/../core/App.php';
require_once __DIR__ . '/../exceptions/AppException.php';
require_once __DIR__ . '/../exceptions/QueryException.php';
require_once __DIR__ . '/../exceptions/FileException.php';
require_once __DIR__ . '/../database/QueryBuilder.php';


$errores = [];
$mensaje = "";

$nombre ='';
$apellidos = '';
$email = '';
$asunto = '';

try {
    $config = require_once '../app/config.php';
    App::bind('config', $config);
    $connection = App::getConnection();
    $contactosRepository = new ContactosRepository();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = trim(htmlspecialchars($_POST['nombre']));
        $apellidos = trim(htmlspecialchars($_POST['apellidos']));
        $email = trim(htmlspecialchars($_POST['email']));
        $asunto = trim(htmlspecialchars($_POST['asunto']));

        $tiposAcertados = ['image/jpeg', 'image/png', 'image.gif'];

        $imagen = new File('imagen', $tiposAcertados);
        $imagen->saveUploadFile(Contacto::RUTA_IMAGENES_CONTACTO);

        $contacto = new Contacto($nombre, $apellidos, $email, $asunto, $imagen->getFileName());
        $contactosRepository->save($contacto);

        if (empty($nombre)) {
            $errores[] = "El nombre no puede estar vacio";
        }
        if (empty($email)) {
            $errores[] = "El email no puede estar vacio";
        } else {
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $errores[] = "El email no es valido";
            }
        }
        if (empty($asunto)) {
            $errores[] = "El asunto no puede estar vacio";
        }
        if (empty($errores)) {
            $mensaje = "los datos del formulario son correctos";
        }
    }
    $contactos = $contactosRepository->findAll();
}catch (QueryException $exception) {
    throw new QueryException("Error de base de datos");
} catch (FileException $e) {
    throw new FileException("Error en el fichero");
}
require '../views/contact.view.php';