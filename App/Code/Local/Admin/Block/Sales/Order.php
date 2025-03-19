<?php
class Admin_Block_Sales_Order extends Core_Block_Layout
{
    protected $_model;
    public function __construct()
    {
        $this->setTemplate('admin/sales/order.phtml');
    }
    public function setModel($model)
    {
        $this->_model = $model;
        return $this;
    }
    public function getModel()
    {
        return $this->_model;
    }
}
