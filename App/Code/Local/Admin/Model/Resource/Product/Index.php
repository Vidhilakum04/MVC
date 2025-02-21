<?php
class Admin_Model_Resource_Product_index  extends Core_Model_Resource_Abstract
{
    public function _construct()
    {
        $this->init("catlog_product", "product_id");
    }
}
