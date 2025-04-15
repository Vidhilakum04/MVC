<?php
class Admin_Controller_Category_Index extends Core_Controller_Admin_Action
{
    public function newAction()
    {
        $layout = $this->getlayout();

        $new = $layout->createBlock('admin/Category_Index_new')
            ->setTemplate('admin/Category/index/new.phtml');
        $layout->getChild('content')->addChild('new', $new);
        $layout->getChild('head')->addCss('page/test.css');
        $layout->toHtml();
    }
    public function listAction()
    {
        $layout = $this->getlayout();
        $list = $layout->createBlock('admin/category_index_list');
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
    public function exportAction()
    {
        $format = $this->getRequest()->getParam('format'); // Get format from URL
        $category = $this->getCategoryList(); // Fetch product data

        switch ($format) {
            case 'csv':
                $this->exportCsv($category);
                break;
            // case 'pdf':
            //     $this->exportPdf($products);
            //     break;
            // case 'txt':
            //     $this->exportTxt($products);
            //     break;
            default:
                echo "Invalid format!";
        }
    }

    // Function to fetch product data from DB
    private function getCategoryList()
    {
        $collection = Mage::getModel('catalog/category')
            ->getCollection()
            ->select()
            ->joinLeft(
                ['cp' => 'catalog_category'],
                'main_table.category_id = cp.category_id',
                ['category_id' => 'category_id', 'name' => 'name', 'description' => 'description',  'created_at' => 'created_at', 'updated_at' => 'updated_at']
            )
            ->getData();

        return $collection;
    }

    // Export as XML
    public function exportCsv($category)
    {
        // Prepare CSV file name
        $fileName = 'category_list_' . date('Y-m-d') . '.csv';

        // Set CSV headers for download
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        //Content-Disposition: attachment; → Forces the browser to download the file instead of displaying it.

        // Open output stream for writing
        $output = fopen('php://output', 'w');
        //php://output to send the CSV content directly to the browser (without saving on the server)

        // Write CSV header row
        fputcsv($output, ['category_id', 'Name', 'Description', 'created_at', 'updated_at']);

        // Loop through products and write each row
        foreach ($category as $product) {
            fputcsv($output, [
                $product->getProductId(),
                $product->getName(),
                $product->getDescription(),
                $product->getCreatedAt(),
                $product->getUpdatedAt()
            ]);
        }

        // Close output stream
        fclose($output);
        exit(); // Ensure no extra output is sent
    }
}
