<?php
namespace Models;
class Model
{
    protected $databaseName = 'pipe_tobacco';
    protected $table;
    protected $query = '';
    protected $connection;

    public function __construct()
    {
        global $connections;
        $this->connection = $connections[$this->databaseName];
    }
    public function select($columns = '*')
    {
        if(is_array($columns)) {
            $columns = implode(',', $columns);
        }
        $this->query = 'SELECT ' . $columns . ' FROM ' . $this->table;
        return $this;
    }

    public function where($arrayWhere)
    {
        $this->query .= ' WHERE ';
        $arrayWhereLength = count($arrayWhere);
        //for type of array list like [key => value] means key = value or key in value(array)
        if (array_is_list($arrayWhere)) {
            $i = 0;
            foreach ($arrayWhere as $key => $value) {
                if (is_array($value)) {
                    $this->query .= $key . ' IN (' . implode(',', $value) . ')';
                } else {
                    $this->query .= $key . ' = ' . $value . ' ';
                }
                if ($i < $arrayWhereLength - 1) {
                    $this->query .= ' AND ';
                }
                $i++;
            }
        } else {
            for ($i = 0; $i < $arrayWhereLength; $i++) {
                for ($j = 0; $j < 2; $j++) {
                    $this->query .= $arrayWhere[$i][$j] . ' ';
                }
                if (is_array($arrayWhere[$i][2])) {
                    $this->query .= ' (' . implode(',', $arrayWhere[$i][2]) . ') ';
                }
                if ($i < $arrayWhereLength - 1) {
                    $this->query .= ' AND ';
                }
            }
        }
        return $this;
    }
    public function join($table, $on)
    {
        $this->query .= ' JOIN ' . $table . ' ON ' . $on;
        return $this;
    }
    public function orderBy($conditions){
        if(is_array($conditions)) {
            $conditions = implode(',', $conditions);
        }
        $this->query .= ' ORDER BY ' . $conditions;
        return $this;
    }
    public function groupBy($conditions){
        if(is_array($conditions)) {
            $conditions = implode(',', $conditions);
        }
        $this->query .= ' GROUP BY ' . $conditions;
        return $this;
    }
    public function limit($limit)
    {
        $this->query .= ' LIMIT ' . $limit;
        return $this;
    }
    public function offset($offset)
    {
        $this->query .= ' OFFSET ' . $offset;
        return $this;
    }
    public function get()
    {
        $stmt = $connection->prepare($this->query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function all()
    {
        return $this->get();
    }
    public function first()
    {
        $stmt = $connection->prepare($this->query);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
    //data type is array list like [key => value]
    public function insert($data)
    {
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_values($data));
        $this->query = 'INSERT INTO ' . $this->table . ' (' . $columns . ') VALUES (' . $values . ')';
        $stmt = $connection->prepare($this->query);
        $stmt->execute();
        return $connection->lastInsertId();
    }
    public function update($data)
    {
        $this->query = 'UPDATE ' . $this->table . ' SET ';
        $arrayDataLength = count($data);
        for ($i = 0; $i < $arrayDataLength; $i++) {
            $this->query .= $data[$i][0] . ' = ' . $data[$i][1];
            if ($i < $arrayDataLength - 1) {
                $this->query .= ' , ';
            }
        }
        return $this;
    }
    public function delete()
    {
        $this->query = 'DELETE FROM ' . $this->table;
        return $this;
    }
    public function getQuery()
    {
        return $this->query;
    }
    public function getConnection()
    {
        return $this->connection;
    }
    public function executeRaw($query)
    {
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public static function __callStatic($name, $arguments)
    {
        $model = new static();
        return call_user_func_array([$model, $name], $arguments);
    }
}
