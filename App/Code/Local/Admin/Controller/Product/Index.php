<?php
class Admin_Controller_Product_Index extends Core_Controller_Admin_Action
{
    // // protected $_allowedActions = ['list'];
    public function newAction()
    {
        $layout = Mage::getBlock('core/layout');
        $new = $layout->createBlock('admin/product_index_new')
            ->setTemplate('admin/product/index/new.phtml');

        $layout->getChild('content')->addChild('new', $new);
        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('admin/product_index_list')
            ->setTemplate('admin/product/index/list.phtml');
        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
    }
    public function saveAction()
    {
        $request = Mage::getModel('core/request');
        $product = Mage::getModel('catalog/product');
        $pdata = $request->getParam('catalog_product');
        $pdata['sku'] = "{$pdata['category_id']}{$pdata['name']}";
        $product->setData($pdata);
        $product->save();
        $this->redirect('');

        // $attributetable = Mage::getModel('catalog/product_attribute');
    }
    public function deleteAction()
    {
        $request = Mage::getModel('core/request');

        $product = Mage::getModel('catalog/product');
        $productId = $request->getQuery('id');
        $product->load($productId);
        $product->delete();
    }

    /* for testing purpose only */
    public function testAction()
    {
        $layout = Mage::getBlock('core/layout');
        $test = $layout->createBlock('admin/product_index_test')
            ->setTemplate('admin/product/index/test.phtml');
        $layout->getChild('content')->addChild('test', $test);
        $layout->toHtml();
    }
}
