<?php

class Page_Block_Header extends Core_Block_Template
{
    protected $_Permission = [];
    public function __construct()
    {
        $this->setTemplate('page/header.phtml');
    }
    public function getMasterCategories()
    {

        $cat = Mage::getModel('catalog/category')
            ->getCollection();

        return $cat->getData();
    }
    public function setPermission($permission)
    {
        $this->_Permission = $permission;
        return $permission;
    }
    public function getPermission()
    {
        return  $this->_Permission;
    }
}
