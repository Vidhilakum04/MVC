<?php
class Core_Model_Resource_Abstract
{
    protected $_tablename;
    protected $_primarykey; //Stores the name of the primary key column for the table.
    // protected $_columnname;

    public function _construct()
    {
        return $this;
    }
    public function __construct()
    {
        $this->_construct();
    }
    public function init($tablename, $primarykey)
    {
        //Called after the object is created to define which table and primary key the model will use.
        $this->_tablename = $tablename;
        $this->_primarykey = $primarykey;
    }
    public function gettableName()
    {
        return $this->_tablename;
    }
    public function getAdapter()
    {
        //This is likely a database adapter class that handles database queries.
        return new Core_Model_DB_Adapter;
    }
    protected function _getDbColumns()
    {
        $sql = "SELECT COLUMN_NAME
        FROM INFORMATION_SCHEMA.COLUMNS
         WHERE TABLE_NAME = N'{$this->_tablename}'";
        return $this->getAdapter()->fetchCol($sql, 'COLUMN_NAME');
    }

    public function load($value, $field = NULL)
    {        //$value is the value of the column used to find the record.
        // $field (optional) is the column name used for searching (default is the primary key).

        $field = (is_null($field) ? $this->_primarykey : $field);
        $sql =  "SELECT * FROM `{$this->_tablename}` WHERE {$field}='$value' LIMIT 1";
        return  $this->getAdapter()->fetchRow($sql);
    }

    public function save($model)
    {
        //Saves the model data to the database.
        // Handles both INSERT (create) and UPDATE (edit) operations.

        $dbcolumn = $this->_getDbColumns();
        //Gets the model's data (likely an associative array of column values).
        $data = $model->getData();
        $primaryId = 0;
        if (isset($data[$this->_primarykey]) && $data[$this->_primarykey]) {
            $primaryId = $data[$this->_primarykey];
        }
        if ($primaryId) {
            $columns = [];
            unset($data[$this->_primarykey]);
            foreach ($data as $key => $value) {
                if (in_array($key, $dbcolumn)) {
                    $value = ($value !== null) ? $value : '';
                    $columns[] = sprintf("{$key} = '%s'", addslashes($value));
                }
            }
            $columns = implode(",", $columns);
            $sql = sprintf(
                "UPDATE %s SET %s WHERE %s = %d",
                $this->_tablename,
                $columns,
                $this->_primarykey,
                $primaryId
            );
            return $this->getAdapter()->query($sql);
        } else {

            $columns = [];
            $values = [];
            foreach ($data as $key => $value) {
                if (in_array($key, $dbcolumn)) {
                    $columns[] = $key;
                    $values[] = $value;
                }
            }
            $columns = implode(",", $columns);
            $values = implode("','", $values);


            $sql = sprintf(
                "INSERT INTO `%s` (%s) VALUES ('%s')",
                $this->_tablename,
                $columns,
                $values
            );
            $id = $this->getAdapter()->insert($sql);
            $model->{$this->_primarykey} = $id;
        }
    }
    public function delete($model)
    {
        $data = $model->getData();
        $_primarykey = $data[$this->_primarykey];
        $sql = sprintf(
            "DELETE FROM %s WHERE {$this->_primarykey} = %s",
            $this->_tablename,
            $_primarykey
        );
        $id = $this->getAdapter()->query($sql);
        $model->load($id);
        return $this->getAdapter()->query($sql);
    }
}
