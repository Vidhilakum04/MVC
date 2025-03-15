<?php

class Core_Controller_Admin_Action extends Core_Controller_Front_Action
{
    protected $_allowedActions = [];
    public function __construct() // called wehn object of this class is created
    {
        $this->_init(); // which contains authentication checks 
    }
    protected function _init()
    {
        $isLogin = $this->getSession()->get('login'); // return session instance (core/session) and fetches the value of the login key from the session.
        if (!in_array($this->getRequest()->getActionName(), $this->_allowedActions)) { //If the action is in the list, it is considered a publicly accessible admin action (e.g., login page, password reset).and If not in the list, authentication is required.
            if ($isLogin == 1) { //If the session login variable is set to 1, the user is considered logged in, and access is granted
            } else {
                $this->redirect('admin/account/login'); //Otherwise, the user is redirected to the admin login page
            }
        }
    }
}
