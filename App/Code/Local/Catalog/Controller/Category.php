<?php

class Catalog_Controller_Category
{

    public function listAction()
    {
        $layout = Mage::getBlock('core/layout');
        $list = $layout->createBlock('catalog/category_list');
        $layout->getChild('content')->addChild('list', $list);
        $layout->toHtml();
    }

    public function testAction()
    {
        // Include your autoload file

        $pay = new PayPal_Init();
        $paypal = $pay->getApiContext();
        $payer = new PayPal\Api\Payer();

        $payer->setPaymentMethod('paypal');

        $amount = new PayPal\Api\Amount();

        $amount->setTotal('10.00')->setCurrency('USD');

        $transaction = new PayPal\Api\Transaction();

        $transaction->setAmount($amount)->setDescription('Payment for Order #1234');

        $redirectUrls = new PayPal\Api\RedirectUrls();

        $redirectUrls->setReturnUrl("http://localhost/payment/paypal_success.php")

            ->setCancelUrl("http://localhost/payment/paypal_cancel.php");



        $payment = new PayPal\Api\Payment();

        $payment->setIntent('sale')

            ->setPayer($payer)

            ->setRedirectUrls($redirectUrls)

            ->setTransactions([$transaction]);

        try {

            $payment->create($paypal);

            header("Location: " . $payment->getApprovalLink());
        } catch (Exception $ex) {

            echo "Error: " . $ex->getMessage();
        }
        mage::log($payer);
    }
}
