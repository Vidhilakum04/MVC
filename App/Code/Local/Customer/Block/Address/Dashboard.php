<?php
class Customer_Block_Address_Dashboard extends Core_Block_Template
{

    public function getCustomerData()
    {
        $customer = Mage::getModel('customer/account_address')
            ->getCollection();
        mage::log($customer);
        // die;
    }
}
