<?php
class Admin_Model_User extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClassName = "Admin_Model_Resource_User";
        $this->_collectionClassName = "Admin_Model_Resource_User_Collection";
    }
    public function getAdminPermission()
    {
        $permission = Mage::getModel('admin/role')
            ->load($this->getRole());
        return $permission->getPermissions();
    }
}
