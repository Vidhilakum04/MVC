<?php

class Core_Controller_Front_Action extends Core_Controller_Front
{
    public function getRequest() //retrive current request object
    {
        return Mage::getSingleton('core/request'); //which represents an HTTP request
    }
    public function getSession() // Returns the session object for storing user-specific data like messages, authentication status, etc.
    {
        return Mage::getSingleton('core/session');
    }
    public function redirect($url)
    {
        header('location:' . Mage::getBaseUrl() . $url);

        //Fetches the base URL of the Magento store. //Concatenates $url: Appends the provided $url to the base URL.
        //header('location:' . ...): Performs an HTTP redirection.
        return $this; //Allows method chaining. //allowing multiple method calls on the same object in a single statement.
    }
    public function getLayout()
    {
        return Mage::getBlockSingleton("core/layout");
    }
    public function getMessage()
    {
        return Mage::getSingleton('core/messages');
    }
}
