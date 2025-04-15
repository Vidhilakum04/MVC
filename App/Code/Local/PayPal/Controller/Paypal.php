<?php
class PayPal_Conteroller_Paypal
{
    public function successAction()
    {
        require 'paypal_config.php';

        // Make sure the `paymentId` and `PayerID` are passed in the URL
        if (!isset($_GET['paymentId'], $_GET['PayerID'])) {
            die("Payment failed or canceled.");
        }

        $paymentId = $_GET['paymentId'];
        $payerId = $_GET['PayerID'];

        try {
            // Retrieve the payment by ID
            $payment = PayPal\Api\Payment::get($paymentId, $paypal);

            // Create an execution object
            $execution = new PayPal\Api\PaymentExecution();
            $execution->setPayerId($payerId);

            // Execute the payment
            $result = $payment->execute($execution, $paypal);

            // Check if the payment was successful
            if ($result->getState() == 'approved') {
                echo "Payment successful! Transaction ID: " . $result->getId();
            } else {
                echo "Payment not approved.";
            }
        } catch (Exception $ex) {
            echo "Payment execution error: " . $ex->getMessage();
        }
    }
    public function cancelAction() {}
}
