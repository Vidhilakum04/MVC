<?php
class Catalog_Model_Product extends Core_Model_Abstract
{
    public $status = [
        '0' => 'disable',
        '1' => 'enable'
    ];
    public function init()
    {
        $this->_resourceClassName = "Catalog_Model_Resource_Product";
        $this->_collectionClassName = "Catalog_Model_Resource_Product_Collection";
    }
    public function getStatusTxt()
    {
        $statusValue = $this->getStatus();
        return isset($this->status[$statusValue]) ? $this->status[$statusValue] : '';
    }
}
