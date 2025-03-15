<?php
class Checkout_Block_Cart extends Core_Block_Layout
{
    public function indexAction()
    {
        $session = Mage::getSingleton(className: 'checkout/session');
        $cart = $session->getCart();
        $cartData = $cart->getItemCollection()
            ->getData();

        return $cartData;
    }


    public function cartData()
    {
        $session = Mage::getSingleton(className: 'checkout/session');
        $cart = $session->getCart();
        return $cart;
    }
    public function getBillingData()
    {
        // $request = Mage::getModel('checkout/cart');
        // $shipping = Mage::getModel('checkout/session');
        // $cartId = $shipping->getCart()
        //     ->getCartId();

        // $addressId = Mage::getModel('checkout/cart_address')
        //     ->getCollection()
        //     ->addFieldToFilter('cart_id', $cartId)
        //     ->addFieldToFilter('address_type', 'billing');

        // return $addressId->getData();
        $session = Mage::getSingleton('checkout/session');
        $shipping = Mage::getModel('checkout/cart_address')
            ->getCollection()
            ->addFieldToFilter('cart_id',  $session->getCart()->getCartId())
            ->addFieldToFilter('address_type', "Billing");
        return $shipping->getFirstItem();
    }
    public function getShippingData()
    {
        // $request = Mage::getModel('checkout/cart');
        // $shipping = Mage::getModel('checkout/session');
        // $cartId = $shipping->getCart()
        //     ->getCartId();
        // $addressId = Mage::getModel('checkout/cart_address')
        //     ->getCollection()
        //     ->addFieldToFilter('cart_id', $cartId)
        //     ->addFieldToFilter('address_type', 'shipping');
        // return $addressId->getData();
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
