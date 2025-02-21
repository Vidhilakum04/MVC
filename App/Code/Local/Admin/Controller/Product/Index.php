<?php
class Admin_Controller_Product_Index
{
    public function newAction()
    {
        // echo "qwwe";

        $layout = Mage::getBlock('core/layout');
        $new = $layout->createBlock('admin/product_Index_new')
            ->setTemplate('admin/product/index/new.phtml');

        // print_r($new);
        $layout->getChild('content')->addChild('new', $new);
        $layout->getChild('head')->addCss('page/test.css');
        $layout->toHtml();

        // return $product;
    }
    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('admin/product_Index_list')
            ->setTemplate('admin/product/index/list.phtml');
        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
    }
    public function saveAction()
    {
        $request = Mage::getModel('core/request');
        $product = Mage::getModel('catalog/product');

        $old_img = $request->getParam('old_img');
        if (file_exists($old_img)) {
            unlink($old_img);
        }
        $data = $request->getParam('catlog_product');

        ////////////////////////////////////////////////////////

        if (isset($_FILES)) {
            $error = [];

            $file_name = time() . "_" . $_FILES['catlog_product']['name']['image'];

            $file_size = $_FILES['catlog_product']['size']['image'];

            $file_tmp = $_FILES['catlog_product']['tmp_name']['image'];
            $file_type = $_FILES['catlog_product']['type']['image'];
            $ext = explode('.', $file_name);
            $file_ext = strtolower(end($ext));
            $extension = ["jpeg", "jpg", "png"];
            if (move_uploaded_file($file_tmp,  "C:/xampp/htdocs/PHP/MVC/Media   /Product/" . $file_name)) {
                $data['image'] = "Media/Product/" . $file_name;
            }
        }

        ////////////////////////////////////////////////////////

        $product->setData($data);

        $product->save();
        header('location:http://localhost/PHP/MVC/admin/product_index/list');
        $layout = Mage::getBlock('core/layout');
        $save = $layout->createBlock('admin/product_Index_save')
            ->setTemplate('admin/product/index/save.phtml');
        // print_r($save);
        $layout->getChild('content')->addChild('save', $save);
        $layout->toHtml();
    }
    public function deleteAction()
    {
        $request = Mage::getModel('core/request');
        $product = Mage::getModel('catalog/product');
        // $product->setData($request->getParam('catlog_product'));
        $id = $request->getParam('catlog_product');
        $data = $product->load($id['product_id']);
        //////////////////////////////////////////////

        $img = $data->getData()['image'];
        if (file_exists($img)) {
            unlink($img);
        }

        //////////////////////////////////////////////
        $product->delete();
        header('location:http://localhost/PHP/MVC/admin/product_index/list');
        $layout = Mage::getBlock('core/layout');

        $delete = $layout->createBlock('admin/product_Index_delete')
            ->setTemplate('admin/product/index/delete.phtml');
        $layout->getChild('content')->addChild('delete', $delete);
        $layout->toHtml();
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
