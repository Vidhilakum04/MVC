<?php

class Core_Block_Layout extends Core_Block_Template
{
    protected $_head = [];
    protected $_template;
    public function __construct()
    {
        $this->prepareChild();
        $this->prepareJsCss();
        // $this->prepareCss();

        $this->_template = "page/root.phtml";
    }
    public function prepareChild()
    {
        $head = $this->createBlock('page/head');
        $this->addchild('head', $head);

        $header = $this->createBlock('page/header');
        $this->addchild('header', $header);

        $footer = $this->createBlock('page/footer');
        $this->addchild('footer', $footer);

        $content = $this->createBlock('page/content');
        $this->addchild('content', $content);
    }

    public function createBlock($block)
    {
        return Mage::getBlock($block);
    }
    public function prepareJsCss()
    {
        $head = $this->getChild('head');
        // print_r($head);

        // $this->getChild('head');
        // $this->addJs();
        // $this->addCss();
    }
}
