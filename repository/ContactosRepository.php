<?php
/**
 * Created by PhpStorm.
 * User: Sandra
 * Date: 13/12/2018
 * Time: 12:13
 */
require_once __DIR__ . '/../database/QueryBuilder.php';


class ContactosRepository extends QueryBuilder
{

    /**
     * ImagenGaleriaRepository constructor.
     * @param string $table
     * @param string $classEntity
     */
    public function __construct(string $table='contactos', string $classEntity='Contacto')
    {
        parent::__construct($table, $classEntity);
    }
}