<?php
class Sales_Model_Order_Address extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClassName = 'Sales_Model_Resource_Order_Address';
        $this->_collectionClassName = 'Sales_Model_Resource_Order_Address_Collection';
    }
    // public function getBilling()
    // {
    //     return $this->_order->getOrder()->getBillingAddress()->getData();
    // }
    // public function getShipping()
    // {
    //     return $this->_order->getOrder()->getShippingAddress()->getData();
    // }
}
