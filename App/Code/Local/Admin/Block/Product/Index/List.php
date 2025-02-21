<?php

class Admin_Block_Product_Index_List extends Core_Block_Template
{

    public $data;
    public function listData()
    {

        $request = Mage::getModel('catalog/product')
            ->getCollection();
        // print_r($request);
        $data = $request->getData();
        return $data;
    }
}
