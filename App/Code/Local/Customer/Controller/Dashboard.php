<?php
class Customer_Controller_Dashboard extends Core_Controller_Front_Action
{
    public function indexAction()
    {
        $session = $this->getSession();
        $customerId = $session->get('customerId');

        $dashBoardModel = Mage::getModel('customer/account')->load($customerId);

        $layout = Mage::getBlock('core/layout');

        $dashboardBlock = $layout->createBlock('customer/dashboard');
        $dashboardBlock->setModel($dashBoardModel);

        $addressinfo = $layout->createBlock('customer/dashboard_address');
        $dashboardBlock->addChild('address', $addressinfo);

        $itemInfo = $layout->createBlock('customer/dashboard_info');
        $dashboardBlock->addChild('info', $itemInfo);

        $orderinfo = $layout->createBlock('customer/dashboard_order');
        $dashboardBlock->addChild('order', $orderinfo);

        $layout->getChild('content')->addChild('dashboard', $dashboardBlock);

        $layout->toHtml();
    }
    public function viewAction()
    {
        $id = $this->getRequest()->getQuery('id');
        $orderModel = Mage::getModel('sales/order')->load($id);

        $layout = $this->getLayout();

        $orderBlock = $layout->createBlock('admin/sales_order');
        $orderBlock->setModel($orderModel);

        $addressinfo = $layout->createBlock('admin/sales_order_address');
        $orderBlock->addChild('address', $addressinfo);

        $itemInfo = $layout->createBlock('admin/sales_order_items');
        $orderBlock->addChild('items', $itemInfo);

        $detailsInfo = $layout->createBlock('admin/sales_order_details');
        $orderBlock->addChild('details', $detailsInfo);
        $layout->getChild('content')->addChild('order', $orderBlock);

        $layout->toHtml();
    }
}
