<?php
/**
 * Created by PhpStorm.
 * User: Sandra
 * Date: 18/12/2018
 * Time: 8:08
 */

require_once __DIR__ . '/../database/IEntity.php';

class Contacto implements IEntity
{

    const RUTA_IMAGENES_CONTACTO='../images/fotos/';

    /**
     * @var null
     */
    private $id_contacto;
    /**
     * @var string
     */
    private $nombre;
    /**
     * @var string
     */
    private $apellidos;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $asunto;
    /**
     * @var string
     */
    private $nombre_imagen;

    /**
     * Contacto constructor.
     * @param string $nombre
     * @param string $apellidos
     * @param string $email
     * @param string $asunto
     * @param string $nombre_imagen
     */
    public function __construct($nombre='', $apellidos='', $email='', $asunto='', $nombre_imagen='')
    {
        $this->id_contacto = null;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->asunto = $asunto;
        $this->nombre_imagen = $nombre_imagen;
    }

    /**
     * @return null
     */
    public function getIdContacto()
    {
        return $this->id_contacto;
    }

    /**
     * @param null $id_contacto
     * @return Contacto
     */
    public function setIdContacto($id_contacto)
    {
        $this->id_contacto = $id_contacto;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Contacto
     */
    public function setNombre(string $nombre): Contacto
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    /**
     * @param string $apellidos
     * @return Contacto
     */
    public function setApellidos(string $apellidos): Contacto
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Contacto
     */
    public function setEmail(string $email): Contacto
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getAsunto(): string
    {
        return $this->asunto;
    }

    /**
     * @param string $asunto
     * @return Contacto
     */
    public function setAsunto(string $asunto): Contacto
    {
        $this->asunto = $asunto;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombreImagen(): string
    {
        return $this->nombre_imagen;
    }

    /**
     * @param string $nombre_imagen
     * @return Contacto
     */
    public function setNombreImagen(string $nombre_imagen): Contacto
    {
        $this->nombre_imagen = $nombre_imagen;
        return $this;
    }

    public function getUrlImagen() : string {
        return self::RUTA_IMAGENES_CONTACTO.$this->getNombreImagen();
    }

    public function toArray(): array
    {
        return [
            'id_contacto' => $this->getIdContacto(),
            'nombre' => $this->getNombre(),
            'apellidos' => $this->getApellidos(),
            'email' => $this->getEmail(),
            'asunto' => $this->getAsunto(),
            'nombre_imagen' => $this->getNombreImagen()
        ];
    }
}