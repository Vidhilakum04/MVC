<?php
class Admin_Block_Widget_Grid_Filter_Text extends Admin_Block_Widget_Grid_Filter_Abstract
{
    protected $_data = [];
    public function __construct()
    {
        // $this->setTemplate('admin/widget/grid/filter/text.phtml');
    }
    public function render()
    {


        return '<input type="' . $this->getData()['filter'] . '" placeholder="' .  $this->getdata()['data-index'] . '">';
    }
}
