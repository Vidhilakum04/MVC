<?php
class Admin_Block_Product_Index_List2 extends Admin_Block_Widget_Grid
{
    protected $_Collection;
    public function __construct()
    {
        $this->setTemplate('admin/product/index/list2.phtml');
        $this->addcolumn(
            'product_id',
            [
                'render' => 'text',
                'filter' => 'number',
                'data-index' => 'product_id',
                'lable' => 'product_id'
            ]
        );
        $this->addcolumn(
            'name',
            [
                'render' => 'text',
                'filter' => 'text',
                'data-index' => 'name',
                'lable' => 'name'
            ]
        );
        $this->addcolumn(
            'description',
            [
                'render' => 'text',
                'filter' => 'text',
                'data-index' => 'description',
                'lable' => 'description'
            ]
        );
        $this->addcolumn(
            'sku',
            [
                'render' => 'text',
                'filter' => 'text',
                'data-index' => 'sku',
                'lable' => 'sku'
            ]
        );
        $this->addcolumn(
            'price',
            [
                'render' => 'text',
                'filter' => 'number',
                'data-index' => 'price',
                'lable' => 'price'
            ]
        );
        $this->addcolumn(
            'stock_quantity',
            [
                'render' => 'text',
                'filter' => 'number',
                'data-index' => 'stock_quantity',
                'lable' => 'stock_quantity'
            ]
        );
        $this->addcolumn(
            'category_id',
            [
                'render' => 'text',
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
                'class' => ['btn', 'btn-danger'],
                'param' => 'delete',
                'callback' => 'getdeleteUrl'
            ]
        );
        $this->addcolumn(
            'edit',
            [
                'render' => 'link',
                'data-index' => 'product_id',
                'lable' => 'edit',
                'action' => 'edit',
                'class' => ['btn', 'btn-primary'],
                'param' => 'edit',
                'callback' => 'geteditUrl'

            ]
        );
        $this->init();
    }

    public function listData()
    {
        return  $this->getCollection()->getData();
    }
    public function init()
    {
        $collection = Mage::getModel('catalog/product')
            ->getCollection();
        $this->setCollection($collection);
        parent::__construct();
    }
    public function getdeleteUrl($row)
    {
        return $this->getUrl('*/*/delete') . '/?id=' . $row->getProductId();
    }
    public function geteditUrl($row)
    {
        return $this->getUrl('*/*/new') . '/?product_id=' . $row->getProductId();
    }
}
