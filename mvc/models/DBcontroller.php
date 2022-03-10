<?php
class datacontroller
{
    private $host = "localhost";
    private $name = "root";
    private $password = "";
    private $database = "blog";
    private $con;
    function __construct()
    {
        $this->con = $this->dbconnect();
    }
    function dbconnect()
    {
        $conn = mysqli_connect($this->host, $this->name, $this->password, $this->database);
        return $conn;
    }
    function BindQueryParams($sql, $param_type, $param_array)
    {
        $param_array_reference[] = &$param_type;
        for ($i = 0; $i < count($param_array); $i++) {
            $param_array_reference[] = &$param_array[$i];
        }
        call_user_func_array(array($sql, 'bind_param'), $param_array_reference);
    }
    function RunBaseQuery($sql)
    {
        $fetchresult = array();
        $result = $this->con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fetchresult[] = $row;
            }
        }
        return $fetchresult;
    }
    function runquery($sql, $param_type, $param_array)
    {
        try {
            $this->con->begin_transaction();
            $fetchresult = array();
            $query = $this->con->prepare($sql);
            $this->BindQueryParams($query, $param_type, $param_array);
            $query->execute();
            $result = $query->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // $fetchresult[] = $row;
                    array_push($fetchresult, $row);
                }
            }
            $this->con->commit();
            return $fetchresult;
        } catch (Exception $e) {
            // An exception has been thrown
            // We must rollback the transaction
            $this->con->rollback();
        }
    }

    function insert($sql, $param_type, $param_array)
    {
        $query = $this->con->prepare($sql);
        $this->BindQueryParams($query, $param_type, $param_array);
        $query->execute();
        $insertId = $query->insert_id;
        return $insertId;
    }
    function update($sql, $param_type, $param_array)
    {
        $query = $this->con->prepare($sql);
        $this->BindQueryParams($query, $param_type, $param_array);
        $query->execute();
    }
}