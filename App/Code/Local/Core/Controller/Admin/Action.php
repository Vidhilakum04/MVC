<?php
class Core_Controller_Admin_Action extends Core_Controller_Front_Action
{
    protected $_allowed = [
        'login'
    ];
    protected $_roleallowed = [];
    public function __construct()
    {
        $this->init();
    }
    public function getRolePermissions()
    {
        $user = Mage::getSingleton('admin/user')
            ->load($this->getSession()->get('admin_id'));
        $permissions = $user->getAdminPermission();
        $this->setRole($permissions);

        $link = $this->getLayout()->getChild('header')->setPermission($this->getRole());
        // $link->getPermission();
        mage::log($this->getLayout()->getChild('header'));
    }
    public function getRole()
    {
        return $this->_roleallowed;
    }
    public function setRole($_roleallowed)
    {
        $this->_roleallowed = json_decode($_roleallowed);

        return $this;
    }

    public function init()
    {
        $this->getRolePermissions();
        $roleAllow = $this->getRequest()->getControllerName() . "/" . $this->getRequest()->getActionName();
        $islogin = $this->getSession()->get('login');
        if (!in_array($this->getRequest()->getActionName(), $this->_allowed)) {
            if ($islogin === 1 && in_array($roleAllow, $this->_roleallowed)) {

                // $this->redir/ect('admin/product_index/list');
            } else {
                $this->redirect('admin/account/login'); //redirect to home cms
            }
        }
    }
    public function getLayout()
    {
        return Mage::getBlockSingleton("core/layout_admin");
    }
}
