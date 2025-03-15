<?php
class Catalog_Controller_Product
{
    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('catalog/product_list')
            ->setTemplate('catalog/product/list.phtml');
        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
    }

    public function viewAction()
    {
        $product = Mage::getModel('catalog/product');
        $request = $product->getResourceModel();
        $layout = Mage::getBlock('core/layout');
        $view = $layout->createBlock('catalog/product_view')
            ->setTemplate('catalog/product/view.phtml');

        $layout->getChild('content')->addChild('view', $view);

        $layout->toHtml();
    }
    public function TestAction()
    {

        // $checkout = Mage::getModel('checkout/session')
        //     ->getCart()
        //     ->getItemCollection();
        // $checkout->select(['sum(main_table.sub_total)' => 'subTotal']);

        // Mage::log($checkout->prepareQuery('item_id'));
    }
}
