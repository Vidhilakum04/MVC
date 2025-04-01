<?php
class Customer_Block_Dashboard_address extends Core_Block_Template
{

    public function __construct()
    {
        $this->setTemplate('customer/dashboard/Address.phtml');
    }

    public function getCustomerModel()
    {
        return $this->getParent()->getModel();
        //getParent gives dashboard
        //getModel gives customer/account Model -> customer tables -> that has customer_id
        // call here first block(layout:addchild) and then model of parent (like:order)
    }
    // public function customerId()
    // {
    //     $request = Mage::getModel('core/request');
    //     $session = Mage::getSingleton('core/session');
    //     $customerId = $session->get('customer_id');

    //     return $customerId;
    // }
    public function dashboardAddress()
    {

        $customerId = $this->getCustomerModel()->getCustomerId();
        $address = Mage::getModel('customer/account_address')
            ->getCollection()
            ->addFieldToFilter('customer_id', $customerId)
            ->addFieldToFilter('default_address', '0')
            ->getData();
        return $address;
    }

    public function getDefaultAddress()
    {
        $id = $this->getCustomerModel()->getCustomerId();
        $defaultAddress = Mage::getModel("customer/account_address")
            ->getCollection()
            ->addFieldToFilter("customer_id", $id)
            ->addFieldToFilter("default_address", '1')
            ->getData();
        return $defaultAddress;
    }
}
