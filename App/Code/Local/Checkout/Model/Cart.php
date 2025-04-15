<?php
class Checkout_Model_Cart extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClassName = 'Checkout_Model_Resource_Cart';
        $this->_collectionClassName = 'Checkout_Model_Resource_Cart_Collection';
    }
    public function addProduct($cartData)
    {

        // $productData = Mage::getModel('checkout/cart');
        $cartitem = Mage::getModel('checkout/cart_item');
        $productCart = Mage::getModel('catalog/product')
            ->getCollection()
            ->addFieldToFilter('product_id', $cartData['product_id']);
        $productdata = $productCart->getData();
        $data = $cartitem->setData($cartData);
        $cartid = $cartitem->setCartId($cartData);
        $cartitem = $cartitem->setPrice($productdata[0]->getPrice());
        $cartitemid = $cartitem->setCartId($this->getCartId());

        $cartitem = $cartitem->setSubTotal($productdata[0]->getPrice() * $cartData['product_quantity']);


        $cartitem->save();
        return $this;
    }
    public function getItemCollection()
    {
        $cart = Mage::getModel('checkout/cart_item')
            ->getCollection()
            ->addFieldToFilter('cart_id', $this->getCartId());

        return $cart;
    }

    public function removeItem($itemId)
    {
        $itemCollection = $this->getItemCollection()
            ->addFieldToFilter('item_id', $itemId);
        foreach ($itemCollection->getData() as $item) {
            if ($item->getItemId() == $itemId) {

                $item->delete();
            }
        }
        return $this;
    }
    public function updateItem($itemId, $productQuantity)
    {
        $itemCollection = $this->getItemCollection()
            ->addFieldToFilter('item_id', $itemId);

        foreach ($itemCollection->getData() as $item) {
            if ($item->getItemId() == $itemId) {
                $item->setProductQuantity($productQuantity);
                $item->setSubTotal($productQuantity * $item->getPrice());
                $item->save();
            }
        }
        return $this;
    }
    protected function _beforeSave()
    {
        $itemCollection = $this->getItemCollection()->select(["SUM(main_table.sub_total)" => "total_amount"]);
        $totalSubTotal = $itemCollection->getFirstItem()->getTotalAmount();

        // $this->setTotalAmount($totalSubTotal);
        // coupon
        $couponCode = $this->getCouponCode();
        if ($couponCode != null) {
            $couponModel = Mage::getModel("checkout/coupon");

            if (array_key_exists($couponCode, $couponModel->getAllCoupons())) {
                $couponDiscount = 0;
                if ($totalSubTotal !== 0) {
                    $couponDiscount = $couponModel->calculateDiscount($couponCode, $totalSubTotal);

                    $this->setCouponDiscount($couponDiscount);
                }
            } else {
                $this->setCouponCode("NULL");
            }
        }
        $shipping = Mage::getModel('checkout/shipping');
        $shippingCharges = $this->getShippingCharges();
        $this->setTotalAmount((float)$totalSubTotal - (float)$couponDiscount + (float)$shippingCharges);

        return $this;
    }
    public function getAddressCollection()
    {
        $cart = Mage::getModel('checkout/cart_address')
            ->getCollection()
            ->addFieldToFilter('cart_id', $this->getCartId());

        return $cart;
    }
    public function getBillingAddress()
    {
        $billing = $this->getAddressCollection()
            ->addFieldToFilter('address_type', 'billing')
            ->getFirstItem();

        return $billing;
    }
    public function getShippingAddress()
    {
        $shipping = $this->getAddressCollection()
            ->addFieldToFilter('address_type', "Shipping")
            ->getFirstItem();

        return $shipping;
    }
}
