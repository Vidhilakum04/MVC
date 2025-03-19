<?php
class Customer_Controller_Account extends Core_Controller_Front_Action
{
    protected $_allowedActions = [
        'login',
        'loginPost'
    ];
    public function loginAction()
    {
        $layout = Mage::getBlock('core/layout');
        $login = $layout->createBlock('customer/account_login')
            ->setTemplate('customer/account/login.phtml');
        $layout->getChild('content')->addChild('login', $login);
        $layout->toHtml();
    }
    public function loginPostAction()
    {
        $session = Mage::getSingleton('core/session');
        $params = $this->getRequest()->getParams();
        mage::log($params);
        $admin = Mage::getModel('customer/account')
            ->setData($params);
        // ->getCollection()
        // ->addFieldToFilter('email', $this->getCustomerId());

        // ->setEmail('email', $params->getEmail());
        mage::log($admin);

        if ($params['email'] == $admin->getEmail() && $params['password'] == $admin->getPassword()) {
            $session->set('login', 1);
            // $this->redirect('');
        } else {
            $session->remove('login');
            $this->redirect('customer/account/login');
        }
    }
    public function logoutAction()
    {
        $session = Mage::getSingleton('core/session');
        if ($session->get('login')) {
            $session->remove('login');
        }
        $this->redirect('');
    }
    public function registrationAction()
    {
        $layout = Mage::getBlock('core/layout');
        $registration = $layout->createBlock('customer/account_registration')
            ->setTemplate('customer/account/registration.phtml');
        $layout->getChild('content')->addChild('registration', $registration);
        $layout->toHtml();
        // $this->redirect('customer/account/login.phtml');
    }
    public function registerPostAction()
    {
        $session = Mage::getSingleton('core/session');
        $params = $this->getRequest()->getParams();

        $admin = Mage::getModel('customer/account')
            ->setData($params);


        if ($params['email'] == $admin->getEmail() && $params['password'] == $admin->getPassword() && $params['password'] == $params['confirm_password']) {
            $session->set('registration', 1);
            // $this->redirect('');
        } else {
            $session->remove('registration');
            $this->redirect('customer/account/login');
        }
    }
}
