<?php

class Admin_Block_Widget_Grid_Filter_Abstract
{
    protected $_data;
    protected $_row;
    public function render()
    {
        return `<span>` . $this->getValue() . `</span>`;
    }
    public function getValue()
    {
        return $this->_row->{$this->_data['filter']};
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
}
