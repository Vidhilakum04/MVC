<?php
class Admin_Block_Sales_Order_List extends Core_Block_Layout
{
    public function getOrder()
    {
        $request = Mage::getModel('sales/order')
            ->getCollection();
        $order = $request->getData();
        return $order;
    }
}
