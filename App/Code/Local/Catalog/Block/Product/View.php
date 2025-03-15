<?php

class Catalog_Block_Product_View extends Core_Block_Template
{
    public function viewData()
    {
        $request = Mage::getModel('catalog/product')
            ->getCollection();
        $data = $request->getData();
        return $data;
    }
    public function detailData()
    {
        $request = Mage::getModel('core/request');
        $productId = $request->getQuery('id');
        $collections = Mage::getModel("catalog/product")
            ->load($productId);
        return $collections;
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
    public function getImages()
    {
        $product = Mage::getModel('catalog/product')
            ->getCollection()
            ->joinLeft(['cmg' => 'catalog_media_gallery'], 'main_table.product_id=cmg.product_id', ['file_path' => 'file_path'])
            ->groupBy(['main_table.product_id']);

        return $product->getData();
    }
}
