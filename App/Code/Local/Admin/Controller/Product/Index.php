<?php
class Admin_Controller_Product_Index extends Core_Controller_Admin_Action
{
    protected $_allowedActions = [
        'list',
        'save',
        'new',
        'delete'
    ];
    public function newAction()
    {
        $layout = $this->getlayout();
        $new = $layout->createBlock("Admin/Product_Index_New")
            ->setTemplate('admin/product/index/new.phtml');
        $layout->getChild('content')->addChild('new', $new);
        $layout->toHtml();
    }
    public function list2Action()
    {
        $layout = $this->getlayout();
        $list = $this->getlayout()->createBlock('admin/product_index_list2');

        // ->setTemplate('admin/product/index/list2.phtml');
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

        $productId = $request->getQuery('id');
        $product = Mage::getModel('catalog/product');
        $product->load($productId);
        $product->delete();
    }
    public function exportAction()
    {
        $format = $this->getRequest()->getParam('format'); // Get format from URL
        $fileName = 'product_list_' . date('Y-m-d') . '.csv';

        // Set CSV headers for download
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');

        // Open output stream for writing
        $output = fopen('php://output', 'w');

        // Write CSV header row
        fputcsv($output, ['Product ID', 'Name', 'SKU', 'Price', 'Description', 'Stock', 'Category ID']);

        $products = Mage::getModel('catalog/product')
            ->getCollection()
            ->select()
            ->joinLeft(
                ['cp' => 'catalog_product'],
                'main_table.product_id = cp.product_id',
                ['product_id' => 'product_id', 'name' => 'name', 'description' => 'description', 'sku' => 'sku', 'price' => 'price', 'stock_quantity' => 'stock_quantity', 'category_id' => 'category_id']
            )
            ->getData(); // Fetch product data
        // Loop through products and write each row
        foreach ($products as $product) {
            fputcsv($output, [
                $product->getProductId(),
                $product->getName(),
                $product->getPrice(),
                $product->getDescription(),
                $product->getSku(),
                $product->getStockQuantity(),
                $product->getCategoryName()
            ]);
        }
        // Close output stream
        fclose($output);
        exit(); // Ensure no extra output is sent
    }
}
