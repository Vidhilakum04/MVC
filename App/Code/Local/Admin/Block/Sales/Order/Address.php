<?php
class Admin_Block_Sales_Order_Address extends Core_Block_Template
{

    // protected $_order;

    public function __construct()
    {
        $this->setTemplate('admin/sales/order/Address.phtml');
    }

    public function getOrderModel()
    {
        return $this->getParent()->getModel(); // call here first block(layout:addchild) and then model of parent (like:order)
    }
}
