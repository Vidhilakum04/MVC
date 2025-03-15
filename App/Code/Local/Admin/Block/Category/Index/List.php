<?php
class Admin_Block_Category_Index_List extends Core_Block_Template
{
    public function listData()
    {
        $request = Mage::getModel('catalog/category')
            ->getCollection();
        $data = $request->getData();
        return $data;
    }
}
