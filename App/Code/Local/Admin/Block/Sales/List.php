<?php
class Admin_Block_Sales_List extends Core_Block_Layout
{
    public function listData()
    {
        $request = Mage::getModel('core/request');
        $order = Mage::getModel('admin/sales/list')
            ->getCollection();
        // $categoryid = $request->getQuery('categoryid');

        // $product->addFieldToFilter('main_table.category_id', $categoryid);
        $product = $order->getData();
        return $product;
    }
}
