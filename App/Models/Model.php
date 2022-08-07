<?php
namespace App\Models;
class Model
{
    protected $databaseName = 'pipe_tobacco';
    protected $table;
    protected $query = '';
    protected $connection;
    protected $primaryKey = 'id';

    public function __construct()
    {
        global $connections;
        $this->connection = $connections[$this->databaseName];
    }
    public static function select($columns = '*')
    {
        $model = new static();
        $model->query = "SELECT $columns FROM {$model->table}";
        return $model;
    }

    public function where($arrayWhere)
    {
        if ($this->query == '') {
            $this->query = "SELECT * FROM {$this->table} ";
        }
        $this->query .= ' WHERE ';
        $arrayWhereLength = count($arrayWhere);
        //for type of array list like [key => value] means key = value or key in value(array)
        if (array_is_list($arrayWhere)) {
            $i = 0;
            foreach ($arrayWhere as $key => $value) {
                if (is_array($value)) {
                    $this->query .= $key . ' IN (' . implode(',', $value) . ')';
                } else {
                    if (is_numeric($value)) {
                        $value = $value;
                    } else {
                        $value = "'$value'";
                    }
                    $this->query .= $key . ' = ' . $value . ' ';
                }
                if ($i < $arrayWhereLength - 1) {
                    $this->query .= ' AND ';
                }
                $i++;
            }
        } else {
            for ($i = 0; $i < $arrayWhereLength; $i++) {
                $key = $arrayWhere[$i][0];
                $condition = $arrayWhere[$i][1];
                $value = $arrayWhere[$i][2];
                if (is_numeric($value)) {
                    $value = $value;
                } else {
                    $value = "'$value'";
                }
                $this->query .= $key . ' ' . $condition . ' ';
                if (is_array($arrayWhere[$i][2])) {
                    $this->query .= ' (' . implode(',', $arrayWhere[$i][2]) . ') ';
                }
                else{
                    $this->query .= $value . ' ';
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
    public function orderBy($conditions)
    {
        if (is_array($conditions)) {
            $conditions = implode(',', $conditions);
        }
        $this->query .= ' ORDER BY ' . $conditions;
        return $this;
    }
    public function groupBy($conditions)
    {
        if (is_array($conditions)) {
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
        try {
            $result = $this->connection->query($this->query);
            $data = $result->fetchAll();
            return $data;
        } catch (Exception $e) {
            writeLog($e);
            return false;
        }
    }
    public static function all()
    {
        $model = new static();
        $model->query = "SELECT * FROM {$model->table}";
        return $model->get();
    }
    public function first()
    {
        try {
            $this->limit(1);
            $result = $this->get();
            if (count($result) > 0) {
                return $result[0];
            } else {
                return null;
            }
        } catch (\Exception $e) {
            writeLog($e);
            return null;
        }
    }
    public static function insert($data)
    {
        try {
            foreach ($data as $key => $value) {
                if (!is_numeric($value)) {
                    $data[$key] = "'$value'";
                }
            }
            $model = new static();
            $columns = implode(',', array_keys($data));
            $values = implode(',', array_values($data));
            $model->query = "INSERT INTO {$model->table} ($columns) VALUES ($values)";
            $stmt = $model->connection->prepare($model->query);
            $stmt->execute();
            return $model->connection->lastInsertId();
        } catch (\Exception $e) {
            writeLog($e);
            return null;
        }
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
        try {
            $result = $this->connection->query($query);
            $data = $result->fetchAll();
            return $data;
        } catch (Exception $e) {
            writeLog($e);
            return false;
        }
    }
    public static function find($id)
    {
        $model = new static();
        $model->where([[$model->primaryKey, '=', $id]]);
        return $model->first();
    }
    public static function __callStatic($name, $arguments)
    {
        $model = new static();
        return call_user_func_array([$model, $name], $arguments);
    }
    public function save($data)
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
}
