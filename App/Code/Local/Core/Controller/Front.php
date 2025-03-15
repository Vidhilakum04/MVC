<?php

class Core_Controller_Front
{
    public function init()
    {
        $request = Mage::getModel("core/request");
        $class = sprintf("%s_Controller_%s", $request->getModuleName(), $request->getControllerName());

        $class = ucwords($class, "_");
        $obj = new $class();
        $actionName = $request->getActionName() . "action";
        $obj->$actionName();
    }
}
