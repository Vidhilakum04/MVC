<?php

class Admin_Block_Category_Index_New extends Core_Block_Template
{
    public $data;

    public function getCategorydata()
    {
        $request = Mage::getModel('core/request');
        $categoryId = $request->getQuery('id');

        $categoryData = Mage::getModel('catalog/category')
            ->load($categoryId);
        return $categoryData;
    }
    public function getCategory()
    {
        $category = Mage::getModel('catalog/category')->getCollection();
        return $category->getData();
    }
}
