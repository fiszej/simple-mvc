<?php
declare(strict_types=1);

namespace app\src\core;

use app\src\core\App;
use Exception;

class QueryBuilder
{
    public array $fields = [];

    public array $table = [];

    public array $vars = [];


    public function select($select) 
    {
        $this->fields[] = $select;
        return $this;
    }

    public function from($table) 
    {
        $this->table[] = $table;
        return $this;
    }

    public function where($where)
    {
        $this->vars[] = $where;
        return $this;
    }

    public function executeSelectQuery()
    {
        try {
            $where = $this->vars === [] ? '' : " WHERE ".implode(' AND ', $this->vars);
            $sql = "SELECT ". implode(', ', $this->fields)
                    ." FROM ". implode(', ', $this->table)
                    . $where;
            $stmt = App::$db->pdo->prepare($sql);
            $stmt->execute();
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function insert($table, $fields)
    {
        $this->table[] = $table;
        $this->fields[] = $fields;
        return $this;
    }

    public function values($values)
    {
        if (is_array($values)) {
            foreach ($values as $value) {
                $this->vars[] = $value;
            }
        } else {
            $this->vars[] = $values;
        }
        return $this;
    }

    public function executeInsertQuery()
    {
        try {
            $this->vars = array_map(function($a){
                return "'{$a}'";
            }, array_values($this->vars));

            $sql = "INSERT INTO ".implode(',',$this->table)
                    ."(".implode(',', $this->fields)
                    .") "."VALUES (" . implode(', ', $this->vars).")";  
            $stmt = App::$db->pdo->prepare($sql);
            $stmt->execute();

            return 'succes';

        } catch(Exception $e) {
            return $e->getMessage();
        }
        
       
    }

}