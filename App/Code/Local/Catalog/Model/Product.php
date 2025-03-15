<?php
class Catalog_Model_Product extends Core_Model_Abstract
{
    // public $status = [
    //     '0' => 'disable',
    //     '1' => 'enable'
    // ];
    public function init()
    {
        $this->_resourceClassName = "Catalog_Model_Resource_Product";
        $this->_collectionClassName = "Catalog_Model_Resource_Product_Collection";
    }
    public function getStatusTxt()
    {
        $statusValue = $this->getStatus();
        return isset($this->status[$statusValue]) ? $this->status[$statusValue] : '';
    }
    protected function _afterLoad()
    {
        if ($this->getProductId()) {
            $collection = Mage::getModel("catalog/product_attribute")
                ->getcollection()
                ->addFieldToFilter("product_id", $this->getProductId())
                ->joinLeft(
                    ["attr" => "catalog_attribute"],
                    "attr.attribute_id = main_table.attribute_id",
                    ["name" => "name"]
                );

            foreach ($collection->getData() as $_data) {
                $this->{$_data->getName()} = $_data->getValue();
            }

            $media = Mage::getModel('catalog/media_gallery')
                ->getCollection()
                ->addFieldToFilter("product_id", $this->getProductId());


            $filepath = [];
            foreach ($media->getData() as $filemedia) {
                $filepath[] = $filemedia->getFilePath();
                $this->_data['file_path'] = $filepath;
            }
        }
        return $this;
    }
    protected function _afterSave()
    {
        if (!empty($this->getDeleteImg())) {
            $deleteimg = Mage::getModel('catalog/media_gallery')
                ->getCollection()
                ->addFieldToFilter('product_id', $this->getProductId())
                ->getData();
            foreach ($deleteimg as $key => $value) {
                if (in_array($value->getFilePath(), $this->getDeleteImg())) {
                    $deleteimg[$key]->delete();
                }
                unlink($deleteimg);
            }
        }
        if (!empty($this->getThumbnail())) {
            $thumbnail = Mage::getModel('catalog/media_gallery')
                ->getCollection()
                ->addFieldToFilter('product_id', $this->getProductId())
                ->getData();
            foreach ($thumbnail as $key => $value) {
                if ($value->getFilePath() == $this->getThumbnail()) {

                    $value->setThumbnail(1);
                } else if ($value->getThumbnail() == 1) {
                    $value->setThumbnail(0);
                }
            }
        }

        $attributes = Mage::getModel('catalog/attribute')
            ->getCollection();
        foreach ($attributes->getData() as $_attribute) {
            $productAttributes = Mage::getModel('catalog/product_attribute')
                ->getCollection()
                ->addFieldToFilter('product_id', $this->getProductId())
                ->addFieldToFilter('attribute_id', $_attribute->getAttributeId())
                ->getData();
            $value = $this->{$_attribute->getName()};

            if (isset($productAttributes[0])) {

                $productAttributes[0]->setValue($value)
                    ->save();
            } else {
                Mage::getModel('catalog/product_attribute')
                    ->setAttributeId($_attribute->getAttributeId())
                    ->setProductId($this->getProductId())
                    ->setValue($value)
                    ->save();
            }
        }
        $pid = $this->getProductId();

        $images = Mage::getModel('catalog/media_gallery');
        $imageData = [];
        if (isset($_FILES['catalog_product']['name']['img'])) {
            foreach ($_FILES['catalog_product']['name']['img'] as $key => $value) {
                if (move_uploaded_file($_FILES['catalog_product']['tmp_name']['img'][$key], "media/product/$value")) {
                    $imageData['product_id'] = $pid;
                    $imageData['file_path'] = "media/product/$value";
                    $imageData['type'] = str_replace('image/', '.', $_FILES['catalog_product']['type']['img'][$key]);
                    if ($key == 0) {
                        $thumbnail = 1;
                    } else {
                        $thumbnail = 0;
                    }
                    $imageData['thumbnail'] = $thumbnail;
                    $images->setData($imageData);
                    $images->save();
                }
            }
        }
    }
}
