<?php

class Checkout_Controller_Cart extends Core_Block_Template
{
    public function indexAction()
    {
        $layout = Mage::getBlock('core/layout');
        $index = $layout->createBlock('checkout/cart_index')
            ->setTemplate('checkout/cart/index.phtml');
        //    print_r($view);
        $layout->getChild('content')->addChild('index', $index);
        $layout->toHtml();
    }
    public function updateAction()
    {
        $layout = Mage::getBlock('core/layout');
        $update = $layout->createBlock('checkout/cart_index')
            ->setTemplate('checkout/cart/update.phtml');
        //    print_r($view);
        $layout->getChild('content')->addChild('update', $update);
        $layout->toHtml();
    }
    public function removeAction()
    {
        $layout = Mage::getBlock('core/layout');
        $remove = $layout->createBlock('checkout/cart_index')
            ->setTemplate('checkout/cart/remove.phtml');
        //    print_r($view);
        $layout->getChild('content')->addChild('remove', $remove);
        $layout->toHtml();
    }
    public function addAction()
    {
        $layout = Mage::getBlock('core/layout');
        $add = $layout->createBlock('checkout/cart_index')
            ->setTemplate('checkout/cart/add.phtml');
        //    print_r($view);
        $layout->getChild('content')->addChild('add', $add);
        $layout->toHtml();
    }
}
