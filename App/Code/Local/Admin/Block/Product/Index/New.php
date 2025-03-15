<?php
class Admin_Block_Product_Index_New extends Core_Block_Template
{
    // protected $_product;
    public function getProduct()
    {
        print_r('<pre>');
        $request = Mage::getModel('core/request');
        $productId = $request->getQuery('product_id');
        $data = Mage::getModel('catalog/product')
            ->load($productId);

        return $data;
    }
    public function getCategories()
    {
        $data = Mage::getModel('catalog/category')->getCollection()->getData();
        return $data;
    }
    public function getAttributes()
    {
        $data = Mage::getModel('catalog/attribute')->getCollection()->getData();
        return $data;
    }
    public function getHtmlField($field, $data)
    {
        $field = ucfirst(strtolower($field));
        $className = sprintf("Admin_Block_Html_Elements_%s", $field);
        $element = new $className($data);
        return $element->render();
    }
}
