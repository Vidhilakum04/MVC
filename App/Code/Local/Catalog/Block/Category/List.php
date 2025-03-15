<?php

class Catalog_Block_Category_List extends Core_Block_Template
{
    public $data;
    public function __construct()
    {
        $this->setTemplate('catalog/category/list.phtml');
    }
    public function listData()
    {

        $request = Mage::getModel('catalog/category')
            ->getCollection();
        $data = $request->getData();
        return $data;
    }
}
