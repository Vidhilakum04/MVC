<?php

include_once("./App/code/local/autoload.php");
include_once("./App/Mage.php");

error_reporting(E_ALL);
define("DS", DIRECTORY_SEPARATOR);
date_default_timezone_set('Asia/Kolkata');


Mage::getSingleton('core/session');
Mage::init();
