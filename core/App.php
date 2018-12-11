<?php
/**
 * Created by PhpStorm.
 * User: Sandra
 * Date: 11/12/2018
 * Time: 9:24
 */
require_once 'exceptions/AppException.php'; //no necesita el ../ porque App.php se llama desde galeria.php, y actua como si estuviese allí, por lo que la ruta
//debe ser como si estuviera en galeria.php

class App
{
    private static $container=[];

    /**
     * @param string $key
     * @param $value
     */
    public static function bind (string $key, $value) //Añadir al array
    {
        static::$container[$key]=$value;
    }

    /**
     * @param string $key
     * @return mixed
     * @throws AppException
     */
    public static function get (string $key) //Sacar del array
    {
        if(!array_key_exists($key, static::$container)) //Comprueba si un $key está en el array
            throw new AppException("No se ha encontrado la clave $key en el contenedor");
        return static::$container[$key];
    }

    /**
     * @return PDO
     */
    public static function getConnection() : PDO
    {
        if(!array_key_exists('connection' , static::$container))
            static::$container['connection']=Connection::make();
        return static::$container['connection'];
    }


}