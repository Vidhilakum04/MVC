<?php
class Customer_Block_Dashboard_Order extends Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('customer/dashboard/order.phtml');
    }
    public function getCustomerModel()
    {
        return $this->getParent()->getModel();
    }
    public function getOrderData()
    {
        $id = $this->getCustomerModel()->getCustomerId();

        $order = Mage::getModel('sales/order')
            ->getCollection()
            ->addFieldToFilter('customer_id', $id);

        return $order->getData();
    }
}
