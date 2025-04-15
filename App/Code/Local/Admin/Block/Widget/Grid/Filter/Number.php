<?php
class Admin_Block_Widget_Grid_Filter_Number extends Admin_Block_Widget_Grid_Filter_Abstract
{
    public function __construct()
    {
        // $this->setTemplate('admin/widget/grid/filter/number.phtml');
    }

    public function render()
    {

        return '<input type="' . $this->getData()['filter'] . '" placeholder="' .  $this->getdata()['data-index'] . '">';
    }
}
