<?php

namespace Jelena\Models;

use Exception;
use PDO;

abstract class DB
{
    protected string $error = "";
    protected ?PDO $pdo = null;
    protected ?string $stmt = null;
    protected string $table;

    function __construct () {
        try {
           $this->pdo=new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME."",DB_USER,DB_PASSWORD);
           $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (Exception $ex) { exit($ex->getMessage()); }
    }


    function __destruct(){
        if ($this->stmt!==null) { $this->stmt = null; }
        if ($this->pdo!==null) { $this->pdo = null; }
    }

   protected abstract  function tableName();

    public function get($where = null, $order=null){
        $query = "select * from " . $this->tableName();

        if($where) {
            $query.= " where " . $where;
        }
        if($order) {
            $query.= " order by " . $order;
        }

        $proba=$this->pdo->query($query)->rowCount()>0;
        //var_dump($proba);


        if($proba){
           // var_dump($this->pdo->query($query)->fetchAll());

            return $this->pdo->query($query)->fetchAll();


        }
        else{
            return 0;
               // view('notfound');
        }



    }





    public function insert ($data)
    {
        $cols=array();
        $val=array();
        foreach($data as $column => $value)
        {
            $cols[]="`$column`";
            if($value!="NULL"){
                $value='"'.$value.'"';

            }
            else{
                $value="NULL";
            }
            var_dump($value);
            $val[]=$value;


        }
        $sql = 'INSERT INTO '.$this->tableName().' ('.implode(", ", $cols).') VALUES ('.implode(", ",  $val).') ';
        var_dump($sql);
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($val);
    }

    public function update( $data, $where)
    {

        $setColumn= array();


        foreach ($data as $key => $value)
        {
            $setColumn[] = "{$key} = '{$value}'";

            $val[]=$value;

        }

        $sql = "UPDATE {$this->tableName()} SET ".implode(', ', $setColumn)." WHERE ".$where;
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($val);


    }


}

// (D) DATABASE SETTINGS - CHANGE TO YOUR OWN!
define("DB_HOST", "localhost");
define("DB_NAME", "newssite");
define("DB_CHARSET", "utf8");
define("DB_USER", "root");
define("DB_PASSWORD", "");






