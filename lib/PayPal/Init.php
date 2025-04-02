<?php
class PayPal_Init
{
    public $paypal;

    public function __construct() {}
    public function getApiContext()
    {
        $paypal = new PayPal\Rest\ApiContext(

            new PayPal\Auth\OAuthTokenCredential(

                'AZME8vghOSBi0XNFdclEH1SNjMKSe2aos57Npx-TUms6mHEBeytAUGh-DqgArhVximN9OhLOu40LRbLv',

                'ELPnhl6D2RTSVjNVcJ45spZJDytOeRoxJFy9KG2W5ec3fknT0WekG_rlBhJYDMdm1BFIEUQoc1wyZeLd'

            )

        );

        $paypal->setConfig([

            'mode' => 'sandbox', // Change to 'live' in production 

            'http.ConnectionTimeOut' => 30,

            'log.LogEnabled' => true,

            'log.FileName' => 'PayPal.log',

            'log.LogLevel' => 'DEBUG'

        ]);
        return $paypal;
    }
}
