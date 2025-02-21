<?php

class Catalog_Block_Category_List extends Core_Block_Template
{

    public $data;
    public function __construct()
    {

        $this->setTemplate('catalog/category/list.phtml');


        // return $new;
    }
    public function listData()
    {

        $request = Mage::getModel('catalog/category')
            ->getCollection();
        // print_r($request);
        $data = $request->getData();
        return $data;

        // print_r($id);
        // return Mage::getModel('admin/product_index')->load('82');

        // print_r($data);
    }
}
