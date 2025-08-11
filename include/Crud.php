<?php
require_once("Dbconfig.php");

class Crud 
{
    private $conn;

    public function __construct()
    {
        $dbConnection = new DbConnection();
        $this->conn = $dbConnection->getConnection();
    }

    public function create($data_array, $table)
    {
        // Check if it's a batch insert (i.e., $data_array contains multiple records)
        if (isset($data_array[0]) && is_array($data_array[0])) {
            // Use the keys of the first record for the column names and placeholders
            $columns = implode(",", array_keys($data_array[0]));
            $placeholders = ":" . implode(",:", array_keys($data_array[0]));
    
            $sql = "INSERT INTO $table($columns) VALUES($placeholders) ON DUPLICATE KEY UPDATE updated_at = NOW()";
            
            $statement = $this->conn->prepare($sql);
    
            // Loop through each record and execute the statement
            foreach ($data_array as $record) {
                $statement->execute($record);
            }
    
            // Return the ID of the last inserted record in batch insert
            return $this->conn->lastInsertId();
        } else {
            // Single record insert
            $columns = implode(",", array_keys($data_array));
            $placeholders = ":" . implode(",:", array_keys($data_array));
            
            $sql = "INSERT INTO $table($columns) VALUES($placeholders) ON DUPLICATE KEY UPDATE updated_at = NOW()";
    
            $statement = $this->conn->prepare($sql);
            $statement->execute($data_array);
    
            return $this->conn->lastInsertId();
        }
    }
    

    public function read($sql_query, $params = [])
    {
        try {
            $statement = $this->conn->prepare($sql_query);
    
            // Bind parameters flexibly
            if (array_keys($params) === range(0, count($params) - 1)) {
                // Zero-indexed array, bind parameters starting from 1
                foreach ($params as $index => $value) {
                    $type = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
                    $statement->bindValue($index + 1, $value, $type); // Offset by 1
                }
            } else {
                // Associative array, bind parameters by their keys
                foreach ($params as $key => $value) {
                    $type = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
                    $statement->bindValue($key, $value, $type);
                }
            }
    
            $statement->execute();
    
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Database query error: " . $e->getMessage());
        }
    }
    

    // public function read($sql_query, $params = array())
    // {
    //     $statement = $this->conn->prepare($sql_query);
    //     // Bind parameters
    //     foreach ($params as $param => $value) {
    //         $statement->bindValue($param, $value);
    //     }
    //     $statement->execute($params);
        
    //     return $statement->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function update($sql_query, $params = array()){
        try {
            $statement = $this->conn->prepare($sql_query);
            $result = $statement->execute($params);
            
            if ($result) {
                return true; // Query executed successfully
            } else {
                return false; // Query execution failed
            }
        } catch (PDOException $e) {
            // Handle the exception, log or display an error message
            echo "Error: " . $e->getMessage();
            return false; // Query execution failed due to an exception
        }
    }
    

    public function delete($sql_query, $params = array()){
        try {
            $statement = $this->conn->prepare($sql_query);
            $statement->execute($params);
            // You can also return the number of affected rows if needed:
            // return $statement->rowCount();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            error_log("Database error: " . $e->getMessage());
            throw $e;
        }
    }
    
    
}