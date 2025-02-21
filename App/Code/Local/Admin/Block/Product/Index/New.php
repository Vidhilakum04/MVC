<?php

class Admin_Block_Product_Index_New extends Core_Block_Template
{
    public $data;

    public function getProductdata()
    {
        $request = Mage::getModel('core/request');
        // print_r($request);
        $id = $request->getQuery('id');
        return Mage::getModel('admin/product_index')->load($id);
    }
    public function getcategorydata()
    {
        $category = Mage::getModel('catalog/category')
            ->getCollection();
        $data = $category->getdata();
        // $data->save();
        return $data;
    }
}
