<?php
class Admin_Controller_Category_Index
{
    public function newAction()
    {
        $layout = Mage::getBlock('core/layout');

        $new = $layout->createBlock('admin/Category_Index_new')
            ->setTemplate('admin/Category/index/new.phtml');
        $layout->getChild('content')->addChild('new', $new);
        $layout->getChild('head')->addCss('page/test.css');
        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('admin/category_index_list')
            ->setTemplate('admin/category/index/list.phtml');
        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
    }
    public function saveAction()
    {
        $request = Mage::getModel('core/request');
        $product = Mage::getModel('catalog/category');
        $product->setData($request->getParam('catalog_category'));
        $product->save();
        header('location:http://localhost/PHP/E-commerce/');
    }
    public function deleteAction()
    {
        $request = Mage::getModel('core/request');

        $category = Mage::getModel('catalog/category');
        $categoryId = $request->getQuery('id');
        $category->load($categoryId);
        $category->delete();
    }
    public function testAction()
    {
        $layout = Mage::getBlock('core/layout');
        $test = $layout->createBlock('admin/product_Index_test')
            ->setTemplate('admin/product/index/test.phtml');
        $layout->getChild('content')->addChild('test', $test);
        $layout->toHtml();
    }
}
