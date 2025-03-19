<?php
class Admin_Block_Sales_Order_Details extends Core_Block_Layout
{
    // protected $_order;
    public function __construct()
    {
        $this->setTemplate('admin/sales/order/details.phtml');
    }
    // public function setDetailBlock($orderBlock)
    // {
    //     $this->_order = $orderBlock;
    //     return $this;
    // }
    public function getOrderModel()
    {
        return $this->getParent()->getModel();
    }
}
