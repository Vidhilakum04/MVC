<?php
class Checkout_Model_Convertor_Order
{
    public function convertor($cart)
    {
        $unset = $cart->getData();
        unset($unset['cart_id']);

        $orderNumber = "ORD" . rand(100000, 999999);
        $order = Mage::getModel('sales/order')
            ->setData($unset)
            ->setCreatedAt(date('Y-M-D h:i:s'))
            ->setUpdatedAt(date('Y-M-D h:i:s'))
            ->setOrderNumber($orderNumber)
            ->save();

        $orderId = $order->getOrderId();
        $item = $cart->getItemCollection();
        $itemData = $item->getData();
        foreach ($itemData as $item) {

            $item = $item->getData();

            unset($item['item_id']);
            unset($item['cart_id']);
            $item['order_id'] = $orderId;

            $item = Mage::getModel('sales/order_item')
                ->setData($item)
                ->save();
        }
        $billing = $cart->getBillingAddress();
        $billingData = $billing->getData();
        $shipping = $cart->getShippingAddress();
        $shippingData = $shipping->getData();

        unset($billingData['address_id']);
        unset($billingData['cart_id']);
        unset($shippingData['address_id']);
        unset($shippingData['cart_id']);

        $billingData['order_id'] = $orderId;
        $shippingData['order_id'] = $orderId;

        $billingAddress = Mage::getModel('sales/order_address')
            ->setData($billingData)
            ->save();
        $shippingAddress = Mage::getModel('sales/order_address')
            ->setData($shippingData)
            ->save();
    }
}
