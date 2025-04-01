<?php
class Checkout_Block_Cart extends Core_Block_Layout
{
    public function getCartItems()
    {
        $session = Mage::getSingleton('checkout/session');
        $cart = $session->getCart();
        $cartData = $cart->getItemCollection()
            ->getData();
        return $cartData;
    }

    public function cartData()
    {
        $session = Mage::getSingleton('checkout/session');
        $cart = $session->getCart();
        return $cart;
    }
    public function getBillingData()
    {
        $session = Mage::getSingleton('checkout/session');
        $shipping = Mage::getModel('checkout/cart_address')
            ->getCollection()
            ->addFieldToFilter('cart_id',  $session->getCart()->getCartId())
            ->addFieldToFilter('address_type', "Billing");
        return $shipping->getFirstItem();
    }
    public function getShippingData()
    {
        $session = Mage::getSingleton('checkout/session');
        $shipping = Mage::getModel('checkout/cart_address')
            ->getCollection()
            ->addFieldToFilter('cart_id',  $session->getCart()->getCartId())
            ->addFieldToFilter('address_type', "Shipping");
        return $shipping->getFirstItem();
    }
    public function getmethods()
    {
        return Mage::getSingleton('checkout/shipping')->getmethods();
    }
}
