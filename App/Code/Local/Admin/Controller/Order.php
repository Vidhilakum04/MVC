<?php
class Admin_Controller_Order extends Core_Controller_Admin_Action
{

    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('admin/sales_order_list')
            ->settemplate('admin/sales/list.phtml');
        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
        $this->redirect('admin/order/view');
    }
    public function viewAction()
    {
        $id = $this->getRequest()->getQuery('id');
        $orderModel = Mage::getModel('sales/order')->load($id);

        $layout = Mage::getBlock('core/layout');

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
