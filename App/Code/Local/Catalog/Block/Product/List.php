<?php

class Catalog_Block_Product_List extends Core_Block_Layout
{
    public function __construct()
    {
        $filter = $this->getLayout()->createBlock('catalog/product_list_filter');
        $products = $this->getLayout()->createBlock('catalog/product_list_products');
        $this->addChild('filter', $filter);
        $this->addChild('products', $products);
    }

    // public function getImages()
    // {

    //     $cat = Mage::getSingleton('catalog/filter')
    //         ->getProductCollection();

    //     // $request = Mage::getModel('core/request');
    //     // $categoryid = $request->getQuery('categoryid');
    //     // $product = Mage::getModel('catalog/product')
    //     //     ->getCollection();
    //     // if ($categoryid != '') {
    //     //     $product->addFieldToFilter('main_table.category_id', $categoryid);
    //     // }

    //     $cat->joinLeft(['catalog_media_gallery' => 'catalog_media_gallery'], 'main_table.product_id=catalog_media_gallery.product_id', ['file_path' => 'file_path'])
    //         ->groupBy(['main_table.product_id']);


    //     return $cat->getData();
    // }
    public function getCategories()
    {
        $data = Mage::getModel('catalog/category')->getCollection()->getData();
        return $data;
    }
}
