<?php
class Admin_Block_Product_Index_List extends Admin_Block_Widget_Grid
{
    // protected $_Collection;
    public function __construct()
    {
        $this->addcolumn(
            'product_id',
            [
                'render' => 'number',
                'filter' => 'number',
                'data-index' => 'product_id',
                'lable' => 'product_id'
            ]
        );
        $this->addcolumn(
            'name',
            [
                'render' => 'name',
                'filter' => 'text',
                'data-index' => 'name',
                'lable' => 'name'
            ]
        );
        $this->addcolumn(
            'description',
            [
                'render' => 'name',
                'filter' => 'text',
                'data-index' => 'description',
                'lable' => 'description'
            ]
        );
        $this->addcolumn(
            'sku',
            [
                'render' => 'number',
                'filter' => 'text',
                'data-index' => 'sku',
                'lable' => 'sku'
            ]
        );
        $this->addcolumn(
            'price',
            [
                'render' => 'number',
                'filter' => 'number',
                'data-index' => 'price',
                'lable' => 'price'
            ]
        );
        $this->addcolumn(
            'stock_quantity',
            [
                'render' => 'number',
                'filter' => 'number',
                'data-index' => 'stock_quantity',
                'lable' => 'stock_quantity'
            ]
        );
        $this->addcolumn(
            'category_id',
            [
                'render' => 'number',
                'filter' => 'number',
                'data-index' => 'category_id',
                'lable' => 'category_id'
            ]
        );
        $this->addcolumn(
            'delete',
            [
                'render' => 'link',
                'data-index' => 'product_id',
                'lable' => 'delete',
                'action' => 'delete',
                'class' => ['btn', 'btn-danger']
            ]
        );
        $collection = Mage::getModel('catalog/product')
            ->getCollection();
        $this->setCollection($collection);
        parent::__construct();
    }
}
