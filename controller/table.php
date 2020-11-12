<?php
include "../lib/PDOAdapter.php";
include "../lib/MyLogger.php";
class AgesTable
{
    private $adapter;

    function __construct(){
        $dsn = 'mysql:host=localhost;dbname=inline';
        $username = 'root'; 
        $password = '';
        $errorLogger = new MyLogger('../logs/log_file.txt');
        $this->adapter = new PDOAdapter($dsn, $username, $password, $errorLogger);
    }
    public function allTable(){
        // Вывести всю таблицу
        $sql = "select * from inline.person";
        $sth = $this->adapter->prepare($sql);
        $result = $this->adapter->selectPrepared($sth);
        return $result;
    }

    public function maxAge(){
        // Определить максимальный возраст
        $sql = file_get_contents('../model/max_age.sql');
        $sth = $this->adapter->prepare($sql);
        $result = $this->adapter->selectPrepared($sth);
        return $result;
    }

    public function updateOne(){
        // Найти любую персону, у которой mother_id не задан и возраст меньше максимального
        // изменить у нее возраст на максимальный
        $sql = file_get_contents('../model/update_one.sql');
        $sth = $this->adapter->prepare($sql);
        $result = $this->adapter->executePrepared($sth);
        return $result;
    }

    public function maxAgeList(){
        // Получить список персон максимального возраста (фамилия, имя). 
        // Желательно НЕ ИСПОЛЬЗУЯ полученное на шаге 1 значение.
        $sql = file_get_contents('../model/max_age_list.sql');
        $sth = $this->adapter->prepare($sql);
        $result = $this->adapter->selectPrepared($sth);
        return $result;
    }
}

if( isset($_POST['agelist']) ){
$agesTable = new AgesTable;
$result = $agesTable->maxAgeList();

echo json_encode($result);

/*echo '<pre>';
print_r($result);
echo '</pre>';*/
}