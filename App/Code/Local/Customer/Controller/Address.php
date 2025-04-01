<?php
class Customer_Controller_Address extends Core_Controller_Front_Action
{
    public function newAction()
    {
        // $layout = Mage::getBlock('core/layout_admin');
        // $new = $layout->createBlock('customer/address_new');

        // $layout->getChild('content')->addChild('new', $new);
        // $layout->toHtml();
        // $layout = Mage::getBlock('core/layout_admin');
        $layout = $this->getlayout();
        $new = $layout->createBlock("customer/address_new");
        $layout->getChild('content')->addChild('new', $new);
        $layout->toHtml();
    }
    public function saveAction()
    {

        $request = Mage::getModel('core/request');
        $customerId = $this->getSession()->get('customer_id');

        $newAddress = Mage::getModel('customer/account_address')

            ->setData($request->getParam('customer'))
            ->setDefaultAddress(0)
            ->setCustomerId($customerId, 'customer_id')
            ->save();

        $this->redirect('customer/dashboard/index');
        return $newAddress;
    }

    public function deleteAction()
    {
        $request = Mage::getModel('core/request');
        $id = $request->getQuery('address_id');
        $data = Mage::getModel("customer/account_address")
            ->load($id)
            ->delete();

        $this->redirect("customer/dashboard/index");
    }
}
