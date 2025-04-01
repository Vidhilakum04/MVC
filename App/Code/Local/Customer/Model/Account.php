<?php
class Customer_Model_Account extends Core_Model_Abstract
{
    public function init()
    {

        $this->_resourceClassName = "Customer_Model_Resource_Account";
        $this->_collectionClassName = "Customer_Model_Resource_Account_Collection";
    }
    // public function getCustomerData()
    // {
    //     $session = Mage::getSingleton('core/session');
    //     $customerId = $session->get('customer_id');
    //     $product = Mage::getModel('customer/account_address')
    //         ->getCollection()
    //         ->addFieldToFilter('customer_id', $customerId)
    //         ->getFirstItem();
    //     return $product;
    // }
    // public function getOrderData()
    // {
    //     $order = Mage::getModel('sales/order')
    //         ->getCollection()
    //         ->addFieldToFilter('customer_id', $this->getCustomerId());

    //     return $order->getData();
    // }
    // public function dashboardAddress()
    // {
    //     $session = Mage::getSingleton('core/session');
    //     $customerId = $session->get('customer_id');
    //     $address = Mage::getModel('customer/account_address')
    //         ->getCollection()
    //         ->addFieldToFilter('customer_id', $customerId)
    //         ->addFieldToFilter('default_address', '0')
    //         ->getData();
    //     return $address;
    // }

    // public function getDefaultAddress()
    // {
    //     $defaultAddress = Mage::getModel("customer/account_address")
    //         ->getCollection()
    //         ->addFieldToFilter("customer_id", $this->getCustomerId())
    //         ->addFieldToFilter("default_address", '1')
    //         ->getData();
    //     return $defaultAddress;
    // }
}
