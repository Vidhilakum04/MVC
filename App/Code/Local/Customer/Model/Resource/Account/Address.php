<?php

class customer_Model_Resource_Account_Address extends Core_Model_Resource_Abstract
{
    public function __construct()
    {
        $this->init('customer_address', 'address_id');
    }
}
