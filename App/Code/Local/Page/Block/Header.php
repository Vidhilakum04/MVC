<?php

class Page_Block_Header extends Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('page/header.phtml');
    }
    public function getMasterCategories()
    {

        $cat = Mage::getModel('catalog/category')
            ->getCollection();

        return $cat->getData();
    }
}
?>
<script>
    // alert(1);
    // let filter = {
    //     xyz: function() {
    //         this.xyz();
    //         alert(1);

    //     },
    //     abc: function() {
    //         alert('hey');
    //     }
    // }
    // filter.abc();
</script>