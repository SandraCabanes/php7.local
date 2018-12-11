<?php
/**
 * Created by PhpStorm.
 * User: Sandra
 * Date: 07/12/2018
 * Time: 10:02
 */

class Connection
{
    public static function make(){

        try {
            $config=App::get('config')['database']; //Que coja solo el database del elemento config que hay en el array container

            $connection = new PDO(
                $config['connection'] . ';dbname=' . $config['name'] ,
                $config['username'],
                $config['password'],
                $config['options']
            );
        }catch (PDOException $PDOException){
            die($PDOException->getMessage());
        }
        return $connection;
    }
}