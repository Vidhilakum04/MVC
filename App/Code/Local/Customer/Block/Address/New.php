<?php

class Customer_Block_address_New extends Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('customer/dashboard/new.phtml');
    }
    public function customerId()
    {
        $session = Mage::getSingleton('core/session');
        $customerId = $session->get('customer_id');

        return $customerId;
    }

    public function customerAddress()
    {
        $request = Mage::getModel('core/request');
        $addressId = $request->getQuery('address_id');
        $address = Mage::getModel('customer/account_address')
            // ->dashboardAddress()
            ->load($addressId);

        return $address;
    }
}
