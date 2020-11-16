<?php
include "../lib/PDOAdapter.php";
include "../lib/MyLogger.php";

/**
 * AgesTable - класс работы с таблицей Person
 * @package controller
 */
class AgesTable
{
    /**
     * @var objectClass
     * @param AgesTable параметр принимающий объект класса PDOAdapter
     * для дальнейшего использования в методах текущего класса при подключении к БД
     */
    private $adapter;
    
    /**
     * @uses PDOAdapter()
     * @uses MyLogger()
     * @method присваивает @see adapter объект класса PDOAdapter()
     */
    function __construct(){
        $dsn = 'mysql:host=localhost;dbname=inline';
        $username = 'root'; 
        $password = '';
        $errorLogger = new MyLogger('../logs/log_file.txt');
        $this->adapter = new PDOAdapter($dsn, $username, $password, $errorLogger);
    }

    /**
     * Метод осуществляет выборку из БД, всей таблицы inline.person
     * @return array ассоциативный массив "столбец" => "значение" из таблицы inline.person
     */
    public function allTable(){
        $sql = "select * from inline.person";
        $sth = $this->adapter->prepare($sql);
        $result = $this->adapter->selectPrepared($sth);
        return $result;
    } 

    /**
     * Метод выбирает максимальный возраст из таблицы inline.person
     * @return array массив вида "max_age" => "значение"
     */
    public function maxAge(){
        $sql = file_get_contents('../model/max_age.sql');
        $sth = $this->adapter->prepare($sql);
        $result = $this->adapter->selectPrepared($sth);
        return $result;
    }

    /** 
     * Метод находит в БД персону, у которой знавение в столбце 
     * mother_id не задан и возраст меньше максимального
     * Изменяет у найденной персоны возраст на максимальный.
     * @return int 1 при успешном выполнении запроса в БД
     */
    public function UpdateOne(){
        $sql = file_get_contents('../model/update_one.sql');
        $sth = $this->adapter->prepare($sql);
        $result = $this->adapter->executePrepared($sth);
        return $result;
    }

    /**
     * Выбирает из таблицы inline.person список всех персон с максимальными возрастом
     * @return array ассоциативный массив персон с максимальным возратом
     */
    public function maxAgeList(){
        $sql = file_get_contents('../model/max_age_list.sql');
        $sth = $this->adapter->prepare($sql);
        $result = $this->adapter->selectPrepared($sth);
        return $result;
    }
}

/**
 * $_POST запрос с строковым элементом "request_from_client" вызывет функцию @see maxAgeList()
 */
if( isset($_POST['agelist']) ){
    if($_POST['agelist'] == "request_from_client"){
        $agesTable = new AgesTable;
        $result = $agesTable->maxAgeList();
        echo json_encode($result);
    }
}
