<?php
class Admin_Block_Sales_Order_Items extends Core_Block_Layout
{
    // protected $_order;
    public function __construct()
    {
        $this->setTemplate('admin/sales/order/items.phtml');
    }
    // public function setItemBlock($orderBlock)
    // {
    //     $this->setParent() = $orderBlock;
    //     return $this;
    // }
    public function getOrderModel()
    {
        return $this->getParent()->getModel();
    }
}
