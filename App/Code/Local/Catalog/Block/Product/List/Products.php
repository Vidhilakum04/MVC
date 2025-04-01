<?php

class Catalog_Block_Product_List_Products extends Catalog_Block_Product_List
{
    protected $_Collection;

    public function __construct()
    {
        $this->setTemplate('catalog/product/list/products.phtml');
        //grid-toolbar for pagination
        $toolbar = $this->getLayout()->createBlock('catalog/grid_toolbar');
        $this->addChild('toolbar', $toolbar);

        $this->init();
    }
    public function listData()
    {
        return  $this->getCollection()->getData();
    }
    public function init()
    {
        $this->_Collection = Mage::getSingleton('catalog/filter')
            ->getProductCollection()
            ->joinLeft(['catalog_media_gallery' => 'catalog_media_gallery'], 'main_table.product_id=catalog_media_gallery.product_id', ['file_path' => 'file_path'])
            ->groupBy(['main_table.product_id']);

        $this->getChild('toolbar')->prepareToolbar();
        return $this;
    }
    public function getCollection()
    {
        return $this->_Collection;
    }
}
