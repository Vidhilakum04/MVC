<?php

class Core_Controller_Front
{
    public function init()
    {
        $request = Mage::getModel("core/request");
        $class = sprintf("%s_Controller_%s", $request->getModuleName(), $request->getControllerName());
        // print_r($class);
        $class = ucwords($class, "_");
        // print_r($class);
        $obj = new $class();
        // print_r($obj);
        $actionName = $request->getActionName() . "action";
        // print_r($actionName);
        $obj->$actionName();
        // print_r($obj);
    }
}
