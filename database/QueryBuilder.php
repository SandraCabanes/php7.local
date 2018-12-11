<?php
/**
 * Created by PhpStorm.
 * User: Sandra
 * Date: 07/12/2018
 * Time: 11:33
 */
require_once __DIR__ . '/../exceptions/QueryException.php';
require_once __DIR__ . '/../core/App.php';

class QueryBuilder
{
    private $connection;
    private $table;
    private $classEntity;

    /**
     * QueryBuilder constructor.
     * @param string $table
     * @param string $classEntity
     */
    public function __construct(string $table,string $classEntity)
    {
        $this->connection = App::getConnection();
        $this->table=$table;
        $this->classEntity=$classEntity;
    }

    /**
     * @param string $table
     * @param string $classEntity
     * @return mixed
     * @throws QueryException
     */
    public function findAll():array{
        $sql="SELECT * FROM $this->table";
        //$this->connection->query($sql); INYECCIONES DE SQL
        $pdostatement=$this->connection->prepare($sql);
        if($pdostatement->execute()===false){
            throw new QueryException("no se ha podido ejecutar la query");
        }
        return $pdostatement->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->classEntity);
    }

    public function save(IEntity $entity)
    {
        $parameters=$entity->toArray();
        $sql=sprintf(
            'insert into %s (%s) values (%s)',
            $this->table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );}

}