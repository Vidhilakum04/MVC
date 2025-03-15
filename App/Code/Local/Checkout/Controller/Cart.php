<?php
class Checkout_Controller_Cart extends Core_Controller_Front_Action
{
    public function addProductAction()
    {
        $request = $this->getRequest();
        $cartData = $request->getParam('cart');
        $session = Mage::getSingleton('checkout/session');
        $cart = $session->getCart();
        Mage::log($cart);
        // print_r($cart);
        // die;
        // $cart->getCollection()->preparequery($cart);
        $cart->addProduct($cartData);
        // var_dump($cartData);
        // print_r($cart);
        // die;
        $cart->save();

        $this->redirect('checkout/cart/index');
    }
    public function indexAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('checkout/cart')
            ->setTemplate('checkout/cart/index.phtml');
        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
    }
    public function addressAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('checkout/cart')
            ->setTemplate('checkout/cart/address.phtml');
        $layout->getChild('content')->addChild('list', $list);

        $layout->toHtml();
    }
    public function saveAction()
    {
        $request = Mage::getModel('core/request');
        $address = Mage::getModel('checkout/cart_address');
        $cart = Mage::getModel('checkout/session');
        $cartId = $cart->getCart()
            ->getCartId();
        $address->setData($request->getParam('checkout_cart_address'))
            ->setCartId($cartId)
            ->save();

        $address->setData($request->getParam('checkout_billing_address'))
            ->setCartId($cartId)
            ->save();

        $address->save();
    }

    public function removeAction()
    {
        $request = Mage::getModel('core/request');
        $itemId = $request->getQuery('item_id');
        $itemData = Mage::getModel('checkout/session');
        $removeCart = $itemData->getCart()
            ->removeItem($itemId);
        $removeCart->save();
        $this->redirect('checkout/cart/index');
        return $removeCart;
    }
    public function updateAction()
    {
        $request = Mage::getModel('core/request');
        $itemId = $request->getParam('item_id');
        $productQuantity = $request->getParam('product_quantity');

        $itemData = Mage::getModel('checkout/session');
        $updateCart = $itemData->getCart()
            ->updateItem($itemId, $productQuantity);

        $updateCart->save();
        $this->redirect('checkout/cart/index');
        return $updateCart;
    }
    public function applyCouponAction()
    {
        $couponCode = $this->getRequest()->getParam("coupon_code");
        $cart = Mage::getSingleton("checkout/session")->getCart();

        $cart->setCouponCode($couponCode);
        $cart->save();

        $this->redirect("checkout/cart/index");
    }
    public function addAction()
    {
        $request = $this->getRequest();
        $cartItemData = $request->getParam('cart');
        // $productid = $cartData['product_id'];
        // $quantity = $cartData['product_quantity'];

        // Mage::getModel('cart')
        $session = Mage::getSingleton('checkout/session');
        $cartModel = $session->getCart();
        $cartModel->addProduct($cartItemData);
        // Mage::log($cartModel);
        // die;
        $cartModel->save();
        $this->redirect("checkout/cart/index");
    }
    public function addShippingAction()
    {
        $method = $this->getRequest()->getParam('shippingMethod');

        $shippingMethods = Mage::getModel('checkout/shipping')->getMethods();
        Mage::log($shippingMethods);
        $cart = Mage::getSingleton('checkout/session')->getCart();
        // Mage::log($cart);
        // die;
        $cart->setShippingMethod($method);
        $cart->setShippingCharges($shippingMethods[$method]);
        // mage::log($cart);
        $cart->save();
    }
    public function addPaymentMethod() {}
}
