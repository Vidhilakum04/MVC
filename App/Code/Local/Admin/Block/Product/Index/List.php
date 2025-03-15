<?php
class Admin_Block_Product_Index_List extends Core_Block_Template
{
    public function listData()
    {
        $request = Mage::getModel('core/request');
        $product = Mage::getModel('catalog/product')
            ->getCollection();
        // $categoryid = $request->getQuery('categoryid');

        // $product->addFieldToFilter('main_table.category_id', $categoryid);
        $product = $product->getData();
        return $product;
    }
}