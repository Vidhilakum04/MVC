<?php
class Checkout_Controller_Cart extends Core_Controller_Front_Action
{

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
        $email = $request->getParam("customer_email");
        $shippingAddress = Mage::getModel('checkout/cart_address');
        $billingAddress = Mage::getModel('checkout/cart_address');
        $cart = Mage::getSingleton('checkout/session')->getCart();
        $cartId = $cart->getCartId();
        $cart->setEmail($email);
        $shippingAddress->setData($request->getParam('shipping'))
            ->setCartId($cartId)
            ->setEmail($email)
            ->save();
        $billingAddress->setData($request->getParam('billing'))
            ->setCartId($cartId)
            ->setEmail($email)
            ->save();
        $cart->save();
        // mage::log($cart);
        // die;
        $this->redirect('checkout/cart/placeorder');
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
    public function addProductAction()
    {
        $request = $this->getRequest();
        $cartData = $request->getParam('cart');
        $session = Mage::getSingleton('checkout/session');
        $cart = $session->getCart();

        $cart->addProduct($cartData);
        $cart->save();
        $this->redirect('checkout/cart/index');
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

        $session = Mage::getSingleton('checkout/session');
        $cartModel = $session->getCart();
        $cartModel->addProduct($cartItemData);
        $cartModel->save();
        $this->redirect("checkout/cart/index");
    }
    public function addShippingAction()
    {
        $method = $this->getRequest()->getParam('shippingMethod');
        $shippingMethods = Mage::getModel('checkout/shipping')->getMethods();
        $cart = Mage::getSingleton('checkout/session')->getCart();
        $cart->setShippingMethod($method);
        $cart->setShippingCharges($shippingMethods[$method]);

        $charges = $this->getRequest()->getParam('shippingMethod');
        $cart->setShippingCharges($shippingMethods[$charges]);
        $cart->save();
        $this->redirect("checkout/cart/index");
    }
    public function paymentAction() {}

    public function placeorderAction()
    {
        $cart = Mage::getSingleton('checkout/session')
            ->getCart();
        $order = Mage::getModel('checkout/convertor_order')
            ->convertor($cart);
        $cart->setIsActive(0);

        $cart->save();
        $this->getSession()->remove('cart_id');
    }
}
