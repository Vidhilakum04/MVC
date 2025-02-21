<?php

class Admin_Controller_Customer_Address
{
    public function newAction()
    {
        $layout = Mage::getBlock('core/layout');
        $new = $layout->createBlock('admin/Customer_address_new')
            ->setTemplate('admin/customer/address/new.phtml');
        //    print_r($view);
        $layout->getChild('content')->addChild('new', $new);
        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('admin/Customer_address_list')
            ->setTemplate('admin/customer/address/list.phtml');
        //    print_r($view);
        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
    }
    public function saveAction()
    {
        $layout = Mage::getBlock('core/layout');
        $save = $layout->createBlock('admin/Customer_address_save')
            ->setTemplate('admin/customer/address/save.phtml');
        //    print_r($view);
        $layout->getChild('content')->addChild('save', $save);
        $layout->toHtml();
    }
    public function deleteAction()
    {
        $layout = Mage::getBlock('core/layout');
        $delete = $layout->createBlock('admin/Customer_address_delete')
            ->setTemplate('admin/customer/address/delete.phtml');
        //    print_r($view);
        $layout->getChild('content')->addChild('delete', $delete);
        $layout->toHtml();
    }
}
