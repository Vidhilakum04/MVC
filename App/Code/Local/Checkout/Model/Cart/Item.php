<?php
class Checkout_Model_Cart_Item extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClassName = 'Checkout_Model_Resource_Cart_Item';
        $this->_collectionClassName = 'Checkout_Model_Resource_Cart_Item_Collection';
    }
    public function getProductData()
    {

        $productData = Mage::getModel('catalog/product')
            ->load($this->getProductId());
        return $productData;
    }
    protected function _beforeSave()
    {
        $cartModel = Mage::getModel('checkout/session')
            ->getCart();
        $itemModel = $cartModel->getItemCollection();
        $itemModel->addFieldToFilter('product_id', $this->getProductId());
        $item = $itemModel->getData()[0];
        if (isset($item) && empty($this->getItemId())) {
            $oldQuantity = $item->getProductQuantity();
            $this->setProductQuantity($oldQuantity + $this->getProductQuantity());
            $this->setSubTotal($this->getPrice()  *  $this->getProductQuantity());
            $this->setItemId($item->getItemId());
        }
    }
}
