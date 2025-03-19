<?php
class Checkout_Model_Coupon extends Core_Model_Abstract
{
    protected $_coupon = [
        'abc1' => '40%',
        'abc2' => '25%',
        'abc3' => '10%',
        'trial' => '100'
    ];

    public function getAllCoupons()
    {
        return $this->_coupon;
    }
    public function calculateDiscount($code, $subTotal)
    {
        $coupon = $this->getAllCoupons();
        $discountAmount = 0;

        if (str_contains($coupon[$code], "%")) {
            $discount = substr($coupon[$code], 0, strpos($coupon[$code], "%"));
            $discountAmount = ($subTotal * $discount) / 100;
            return $discountAmount;
        } else {
            $discountAmount = $subTotal - $coupon[$code];
        }
    }
}
