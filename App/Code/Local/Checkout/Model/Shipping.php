<?php
class Checkout_Model_Shipping extends Core_Model_Abstract
{
    public $methods = [

        'bluedart' => 20,
        'fastpost' => 25,
        'indianpost' => 19,
    ];

    public  $shippingMethods = [
        ['id' => 'standard', 'name' => 'bluedart', 'estimate' => '5-7 Business Days', 'price' => 5.99],
        ['id' => 'express', 'name' => 'Express Shipping', 'estimate' => '2-3 Business Days', 'price' => 9.99],
        ['id' => 'overnight', 'name' => 'Overnight Shipping', 'estimate' => '1 Business Day', 'price' => 19.99]
    ];
    public function getMethods()
    {
        return $this->methods;
    }
}
