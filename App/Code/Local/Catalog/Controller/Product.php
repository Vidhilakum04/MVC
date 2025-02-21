<pre>
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
        // print_r($request);
        $layout = Mage::getBlock('core/layout');
        $view = $layout->createBlock('catalog/product_view')
            ->setTemplate('catalog/product/view.phtml');
        $layout->getChild('content')->addChild('view', $view);
        $layout->toHtml();
    }
    public function testAction()
    {
        $product = Mage::getModel('catalog/product')
            ->getCollection()
            ->addFieldToFilter('product_id', 98)
            // ->joinLeft('catlog_category', 'catlog_category.category_id=catlog_product.category_id', ['category_name' => 'name'])
            // ->joinRight('catlog_category', 'catlog_category.category_id =catlog_product.category_id', ['category_name' => 'name'])
            // ->joinInner('catlog_category', 'catlog_category.category_id =catlog_product.category_id', ['category_name' => 'name'])
            ->joinCross('catlog_category', ['category_name' => 'name']);
        // ->joinFull('catlog_category', ['category_name' => 'name'])
        // ->groupBy(['name', 'description'])   
        // ->having('product_id', '10')
        // ->orderBy(['name ASC', 'product_id DESC'])
        // ->limit(3)
        // ->joinSelf(["A", "B"], ['name' => 'A.name', 'price' => 'B.price']);
        $product->getData();
        // print_r($product->getData());
        // print_r($product);
        // die();
        // print_r("<pre>");
    }
}
