<?php

class Sales_Model_Resource_Order_Address extends Core_Model_Resource_Abstract
{
    public function __construct()
    {
        $this->init('order_address', 'address_id');
    }
}
