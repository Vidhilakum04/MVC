<?php

class Admin_Controller_Customer_Index
{
    public function newAction()
    {

        $layout = Mage::getBlock('core/layout');
        $new = $layout->createBlock('admin/Customer_index_new')
            ->setTemplate('admin/customer/index/new.phtml');
        //    print_r($view);
        $layout->getChild('content')->addChild('new', $new);
        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('admin/Customer_index_list')
            ->setTemplate('admin/customer/index/list.phtml');
        //    print_r($view);
        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
    }
    public function saveAction()
    {
        $layout = Mage::getBlock('core/layout');
        $save = $layout->createBlock('admin/Customer_index_new')
            ->setTemplate('admin/customer/index/save.phtml');
        //    print_r($view);
        $layout->getChild('content')->addChild('save', $save);
        $layout->toHtml();
    }
    public function deleteAction()
    {
        $layout = Mage::getBlock('core/layout');
        $delete = $layout->createBlock('admin/Customer_index_new')
            ->setTemplate('admin/customer/index/delete.phtml');
        //    print_r($view);
        $layout->getChild('content')->addChild('delete', $delete);
        $layout->toHtml();
    }
}
