<?php

class Sales_Model_order extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClassName = 'Sales_Model_Resource_Order';
        $this->_collectionClassName = 'Sales_Model_Resource_Order_Collection';
    }
    public function getItemCollection()
    {
        $item = Mage::getModel("sales/order_item")
            ->getCollection()
            ->addFieldToFilter("order_id", $this->getOrderId());
        return $item->getData();
        // mage::log($item);
        // die;
    }

    public function getAddressCollection()
    {
        $address = Mage::getModel("sales/order_address")
            ->getCollection()

            ->addFieldToFilter("order_id", $this->getOrderId());
        return $address;
    }

    public function getBillingAddress()
    {
        return $this->getAddressCollection()
            ->addFieldToFilter('address_type', 'billing')
            ->getFirstItem();
    }

    public function getShippingAddress()
    {
        return $this->getAddressCollection()
            ->addFieldToFilter('address_type', 'shipping')
            ->getFirstItem();
    }
}
