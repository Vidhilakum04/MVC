<?php

class Customer_Controller_Address extends Core_Controller_Front_Action
{

    public function dashboardAction()
    {
        $layout = Mage::getBlock('core/layout');
        $dashboard = $layout->createBlock('customer/address_dashboard')
            ->setTemplate('customer/address/dashboard.phtml');
        $layout->getChild('content')->addChild('dashboard', $dashboard);
        $layout->toHtml();
        mage::log($layout);
    }
}
