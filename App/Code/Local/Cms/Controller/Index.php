<?php

class Cms_Controller_Index extends Core_Controller_Front_Action
{
    public function __construct() {}
    public function indexAction()
    {
        $layout = Mage::getBlock('core/layout');
        $index = $layout->createBlock('cms/index')
            ->setTemplate('cms/index.phtml');
        $layout->getChild('content')->addChild('index', $index);
        $layout->toHtml();
    }
    public function getCategory()
    {
        $cat = Mage::getModel('catalog/category');
    }
}
