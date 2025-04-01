<?php
class Customer_Controller_Account extends Core_Controller_Customer_Action
{
    protected $_allowedActions = [
        'login',
        'loginPost',
        'registration',
        'registerpost'
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
        $loginData = $this->getRequest()->getParam('login');
        $email = $loginData['email'];

        $password = $loginData['password'];
        $user = Mage::getModel('customer/account')
            ->getCollection()
            ->addFieldToFilter('email', $email)
            ->addFieldToFilter('password', $password);
        $result = $user->getFirstItem();

        if ($result->getData()) {
            $this->getSession()->set('login', 1);
            $this->getSession()->set('customerId', $result->getCustomerId());

            $this->redirect(' ');
        } else {
            $this->getSession()->remove('login');

            $this->redirect('customer/account/login');
        }
    }
    public function logoutAction()
    {
        if ($this->getSession()->get('login')) {
            $this->getSession()->remove('login');
            $this->getSession()->remove('customerId');
            // $this->redirect('');
        }
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

        $customer = $this->getRequest()->getParam('customer');
        $address = $this->getRequest()->getParam('address');

        $account = Mage::getModel("customer/account");
        $email = $account->load($customer['email'], 'email');
        if (!$email->getData()) {
            $new = $account->setData($customer)
                ->save();
            $address = Mage::getModel("customer/account_address")
                ->setData($address)
                ->setCustomerId($new->getCustomerId())
                ->setDefaultAddress(1)

                ->save();

            $this->getSession()->set('login', 1);

            $this->getSession()->set('customer_id', $new->getCustomerId());

            $this->redirect("customer/dashboard/index");
        } else {
            echo "email already exits";
        }
    }
}
