<?php

class Admin_Block_Account_Login extends Core_Block_Template
{
    public function getData()
    {
        $request = Mage::getModel('core/request');
        $id = $request::getQuery('id');
        $data = Mage::getModel('catalog/product')
            ->load($id);
        return $data;
    }
}
