<?php
/**
 * Created by PhpStorm.
 * User: Sandra
 * Date: 07/12/2018
 * Time: 11:33
 */

class QueryBuilder
{
    private $connection;

    /**
     * QueryBuilder constructor.
     * @param $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param string $table
     * @param string $classEntity
     * @return mixed
     * @throws QueryException
     */
    public function findAll(string $table,string $classEntity):array{
        $sql="SELECT * FROM $table";
        //$this->connection->query($sql); INYECCIONES DE SQL
        $pdostatement=$this->connection->prepare($sql);
        if($pdostatement->execute()===false){
            throw new QueryException("no se ha podido ejecutar la query");
        }
        return $pdostatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $classEntity);
    }
}