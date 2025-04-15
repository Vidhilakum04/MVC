<?php
class Admin_Block_Category_Index_List extends Admin_Block_Widget_Grid
{
    protected $_Collection;
    public function __construct()
    {
        // $toolbar = $this->getLayout()->createBlock('admin/widget_grid_toolbar');
        // $this->addChild('toolbar', $toolbar);

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
            'parent_id',
            [
                'render' => 'text',
                'filter' => 'number',
                'data-index' => 'parent_id',
                'lable' => 'parent_id'
            ]
        );
        $this->addcolumn(
            'delete',
            [
                'render' => 'link',
                'data-index' => 'category_id',
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
                'data-index' => 'category_id',
                'lable' => 'edit',
                'action' => 'edit',
                'class' => ['btn', 'btn-primary'],
                'param' => 'edit',
                'callback' => 'geteditUrl'

            ]
        );
        $this->init();

        // $toolbar->prepareToolbar();
    }

    public function listData()
    {
        return  $this->getCollection()->getData();
    }
    public function init()
    {
        $collection = Mage::getModel('catalog/category')
            ->getCollection();
        $this->setCollection($collection);
        parent::__construct();
    }
    // public function getCollection()
    // {
    //     return $this->_Collection;
    // }
    public function getdeleteUrl($row)
    {
        return $this->getUrl('*/*/delete') . '/?id=' . $row->getProductId();
    }
    public function geteditUrl($row)
    {
        return $this->getUrl('*/*/new') . '/?product_id=' . $row->getProductId();
    }
}
