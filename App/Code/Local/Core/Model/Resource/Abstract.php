<?php
class Core_Model_resource_Abstract
{
    protected $_tablename;
    protected $_primarykey;
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


        $this->_tablename = $tablename;
        $this->_primarykey = $primarykey;
    }
    public function gettableName()
    {
        return $this->_tablename;
    }
    public function getAdapter()
    {
        return new Core_Model_DB_Adapter;
    }

    public function load($value)
    {

        $sql =  "SELECT * FROM {$this->_tablename} WHERE {$this->_primarykey}='$value' LIMIT 1";
        return  $this->getAdapter()->fetchRow($sql);
    }

    public function save($model)
    {
        $data = $model->getData();
        $primaryId = 0;
        if (isset($data[$this->_primarykey]) && $data[$this->_primarykey]) {
            $primaryId = $data[$this->_primarykey];
        }
        if ($primaryId) {
            $columns = [];
            unset($data[$this->_primarykey]);
            foreach ($data as $key => $value) {
                $value = ($value !== null) ? $value : '';
                $columns[] = sprintf("{$key} = '%s'", addslashes($value));
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
                $columns[] = $key;
                $values[] = $value;
            }
            $columns = implode(",", $columns);
            $values = implode("','", $values);


            $sql = sprintf(
                "INSERT INTO %s (%s) VALUES ('%s')",
                $this->_tablename,
                $columns,
                $values
            );
            $id = $this->getAdapter()->insert($sql);
            $model->load($id);
        }
    }
    public function delete($model)
    {
        $data = $model->getData();
        $_primarykey = $data['product_id'];
        $sql = sprintf(
            "DELETE FROM %s WHERE {$this->_primarykey}=%s",
            $this->_tablename,
            $_primarykey
        );
        $id = $this->getAdapter()->query($sql);
        $model->load($id);
        return $this->getAdapter()->query($sql);
    }
}
