<?php
class Customer_Block_Dashboard_Info extends Core_Block_Template
{

    public function __construct()
    {
        $this->setTemplate('customer/dashboard/info.phtml');
    }

    public function getCustomerModel()
    {
        return $this->getParent()->getModel();
    }
}
