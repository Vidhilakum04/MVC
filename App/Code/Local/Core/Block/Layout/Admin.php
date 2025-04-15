<?php //class Core_Block_Layout_Admin extends Core_Block_Layout
{
    // public function __construct()
    // {
    //     $this->prepareChildren();
    //     $this->prepareJsCss();
    //     $this->_template = 'page/root.phtml';
    // }
    // public function prepareChildren()
    // {
    //     $head = $this->createBlock('page/head')
    //         ->setTemplate("admin/page/head.phtml");
    //     $this->addChild('head', $head);
    //     $header = $this->createBlock('page/header')
    //         ->setTemplate("admin/page/header.phtml");
    //     $this->addChild('header', $header);
    //     $content = $this->createBlock('page/content')
    //         ->setTemplate("admin/page/content.phtml");
    //     $this->addChild('content', $content);
    //     $footer = $this->createBlock('page/footer')
    //         ->setTemplate("admin/page/footer.phtml");
    //     $this->addChild('footer', $footer);
    // }
}

class Core_Block_Layout_Admin extends Core_Block_Layout
{

    public function __construct()
    {
        $this->_template = "page/root.phtml";
        $this->prepareChild();
        $this->preparejscss();
    }
    public function prepareChild()
    {
        $header = $this->createBlock('page/header')
            ->setTemplate('admin/page/header.phtml');
        // print_r($this);
        $this->addChild('header', $header);
        // print_r($this);
        // die();

        $head = $this->createBlock('page/head')
            ->setTemplate('admin/page/head.phtml');
        $this->addchild('head', $head);


        $footer = $this->createBlock('page/footer')
            ->setTemplate('admin/page/footer.phtml');
        $this->addChild('footer', $footer);

        $content = $this->createBlock('page/content')
            ->setTemplate('admin/page/content.phtml');
        $this->addChild('content', $content);
    }

    public function preparejscss()
    {
        $head = $this->getchild('head');
        // ->addJs('page/common.js')
        // ->addCss('page/common.css');
        // print_r($head);
    }

    public function createBlock($block)
    {
        return Mage::getBlock($block);
    }
}
