<?php
class Admin_Block_Product_Index_Test extends Core_Block_Layout
{
    public function gethtmlField($field, $data)
    {
        // print_r("adsdfsgf");
        $field = ucfirst(strtolower($field));
        $classname = sprintf("Admin_Block_Html_Elements_%s", $field);
        // die;
        // print_r($classname);
        $element = new $classname($data);
        return $element->render();
    }
}
