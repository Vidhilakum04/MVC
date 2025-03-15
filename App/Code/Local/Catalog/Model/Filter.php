<?php
class Catalog_Model_Filter extends Core_Model_Abstract
{
    public function getProductCollection()
    {
        $collection = Mage::getModel('catalog/product')
            ->getCollection();
        $this->applyFilter($collection);
        return $collection;
    }
    public function applyFilter($collection)
    {

        $request = Mage::getSingleton('core/request');
        $parameter = $request->getQuery();
        if (isset($parameter['cid'])) {
            $collection->addCategoryFilter($parameter['cid']);
            unset($parameter['cid']);
        }
        if (isset($parameter['min_price'])) {
            $collection->addFieldToFilter('price', ['>=' => $parameter['min_price']]);
            unset($parameter['min_price']);
        }
        if (isset($parameter['max_price'])) {
            $collection->addFieldToFilter('price', ['<=' => $parameter['max_price']]);
            unset($parameter['max_price']);
        }
        // if (isset($parameter['color'])) {
        //     $collection->addFieldToFilter($parameter['color']);
        //     unset($parameter['color']);
        // }
        $attribute = Mage::getModel('catalog/attribute')
            ->getCollection()
            ->addFieldToFilter('name', ['IN' => array_keys($parameter)]);

        foreach ($attribute->getData() as $attributedata) {
            $collection->addAttributeToFilter($attributedata->getName(), $parameter[$attributedata->getName()]);
        }
        return $this;
    }
}
