<?php
class Customer_Block_Dashboard extends Core_Block_Template
{

    protected $_model;
    public function __construct()
    {
        $this->setTemplate('customer/dashboard.phtml');
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
