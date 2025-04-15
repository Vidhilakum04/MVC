<?php

class Admin_Block_Widget_Grid extends Core_Block_Template
{
    protected $_collection;
    protected  $_column = [];
    public function __construct()
    {
        $this->setTemplate('admin/product/index/list2.phtml');
        $this->setTemplate('admin/widget/grid.phtml');

        $toolbar = $this->getLayout()->createBlock('admin/widget_grid_toolbar');
        $this->addChild('toolbar', $toolbar);
        $this->getChild('toolbar')->prepareToolbar();
    }

    public function addcolumn($key, $data)
    {
        $column = Mage::getBlock("admin/widget_grid_column_{$data['render']}");
        $column->setData($data);
        $column->setLink($this);
        $this->_column[$key] = $column;
    }
    public function getcolumn(): array
    {
        return $this->_column;
    }

    public function setCollection($collection)
    {
        $this->_collection = $collection;
        return $this;
    }


    public function getCollection()
    {
        return $this->_collection;
    }
}
