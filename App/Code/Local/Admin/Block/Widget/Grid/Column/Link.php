<?php
class Admin_Block_Widget_Grid_Column_Link extends Admin_Block_Widget_Grid_Column_Abstract
{
    protected $_type = [];
    public function __construct() {}
    public function render()
    {
        $output = '<a href="'  . $this->getLink()->{$this->getData()['callback']}($this->getRow()) . '"';
        $output .= 'class ="' . implode(' ', $this->getData()['class']) . '"';

        if ($this->getData()['action'] == 'delete') {
            $output .= `onclick="return confirm('Are you sure you want to delete this record?');"`;
        }

        $output .= '>';
        $output .= $this->getData()['lable'];
        $output .= '</a>';
        return $output;
    }
}
