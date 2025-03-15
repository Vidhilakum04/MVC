<?php
class Core_Model_DB_Adapter
{
    public $connect = null; //stores the database connection.
    protected $_config = [

        "hostname" => "localhost",
        "dbname" => "ecommerce",
        "username" => "root",
        "password" => "",
        "port" => "3306"

    ];
    public function connect() // establish DB connection
    {
        if ($this->connect == null) { //Checks if $connect is null (i.e., no active connection).

            $this->connect = mysqli_connect( //If null, it creates a connection using mysqli_connect() //Stores the connection in $this->connect for reuse.
                //Prevents multiple database connections (singleton behavior).
                // Efficient: The connection is created only once and reused.
                $this->_config["hostname"],
                $this->_config["username"],
                $this->_config["password"],
                $this->_config["dbname"],
                $this->_config["port"]
            );
        }
        return $this->connect;
    }

    public function fetchAll($query)
    {
        $result = mysqli_query($this->connect(), $query); //Calls connect() to ensure a connection exists.
        $data = [];
        while ($row = $result->fetch_assoc()) { //Fetches all rows from the result set using $result->fetch_assoc().
            $data[] = $row;
        }
        return $data; //Returns $data containing all rows.
    }
    public function fetchRow($query) //returns only one row (useful for getting details of a single record)
    {
        $result = mysqli_query($this->connect(), $query);
        while ($row = $result->fetch_assoc()) { //Loops through results using while ($row = $result->fetch_assoc()), but returns only the first row.
            return $row;
        }
    }
    public function insert($query)
    {
        $result = mysqli_query($this->connect(), $query);
        while ($result) {
            return mysqli_insert_id($this->connect()); //It returns the last inserted ID using mysqli_insert_id()
        }
        return false;
    }
    public function query($query)
    {

        $result = mysqli_query($this->connect(), $query);

        // Returns true for successful queries (INSERT, UPDATE, DELETE).
        // Returns false for failed queries.
        // Returns a mysqli_result object for SELECT queries.
        return $result;
    }
    public function fetchCol($query, $columnName)
    {
        $result = mysqli_query($this->connect(), $query);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row[$columnName];
        }
        return $data;
    }
}
