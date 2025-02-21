<?php

class Cms_Controller_Index extends Core_Controller_Front_Action
{
    public function __construct() {}
    public function indexAction()
    {
        // echo "qqeeee";
        $layout = Mage::getBlock('core/layout');
        $layout->toHtml();
        // echo $class;
    }
}
