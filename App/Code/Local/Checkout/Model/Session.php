<?php

class Checkout_Model_Session extends Core_Model_Session
{
    public function getCart()
    {
        $cart_id = $this->get('cart_id');
        $customer_id = $this->get('customer_id');
        $cart_id = (is_null($cart_id) ? 0 : $cart_id);
        $cartData = Mage::getModel('checkout/cart')
            ->load($cart_id);

        if ($cartData->getCartId() == "") {
            $data = [
                'customer_id' => $customer_id,
                'total_amount' => 0
            ];
            $cartData->setData($data);
            $obj = $cartData->save();
            $id = $obj->getCartId();
            $cartData->load($id);
            $this->set('cart_id', $id);
        }
        return $cartData;
    }
}
