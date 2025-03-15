<?php

class Cms_Block_Index extends Core_Block_Template
{
    public function getImages()
    {
        $product = Mage::getModel('catalog/product')
            ->getCollection()
            ->joinLeft(['cmg' => 'catalog_media_gallery'], 'main_table.product_id=cmg.product_id', ['file_path' => 'file_path'])
            ->groupBy(['main_table.product_id']);

        return $product->getData();
    }
}
