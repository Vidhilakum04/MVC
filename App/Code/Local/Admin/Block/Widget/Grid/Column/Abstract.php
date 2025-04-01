<?php

class Admin_Block_Widget_Grid_Column_Abstract
{
    protected $_data;
    protected $_row;
    protected $_link;

    public function render()
    {
        return `<span>` . $this->getValue() . `</span>`;
    }
    public function getValue()
    {
        return $this->_row->{$this->_data['data-index']};
    }
    public function setData($data)
    {
        $this->_data =  $data;
        return $this;
    }
    public function getData()
    {
        return $this->_data;
    }
    public function setRow($data)
    {

        $this->_row = $data;
        return $this;
    }
    public function getRow()
    {
        return $this->_row;
    }
    public function setLink($link)
    {
        $this->_link = $link;
        return $this;
    }
    public function getLink()
    {
        return $this->_link;
    }

    public function getFilter()
    {
        $filter = Mage::getBlock("admin/widget_grid_filter_{$this->_data['filter']}");
        $filter->setData($this->_data);
        $filter->setRow($this->_row);

        return $filter;
    }
}
