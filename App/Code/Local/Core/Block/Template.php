<?php

class Core_Block_Template
{
    protected $_template;
    protected $_parent = null;
    protected $_child = [];
    public function getParent()
    {
        return $this->_parent;
    }
    public function setParent($parent)
    {
        $this->_parent = $parent;
        return $this;
    }
    public function toHtml()
    {
        include_once(Mage::getBasedirectory() . 'App/design/frontend/template/' . $this->_template);
    }
    public function toHtmlTag()
    {
        include(Mage::getBasedirectory() . 'App/design/frontend/template/' . $this->_template);
    }
    public function addChild($key, $block)
    {
        $this->_child[$key] = $block;
        $block->_parent = $this;
    }
    public function getChild($key)
    {
        return  isset($this->_child[$key]) ? $this->_child[$key] : "";
    }
    public function removeChild($key)
    {
        $this->_child[$key];
    }
    public function getChildHtml($key)
    {
        if ($key == '' && count($this->_child)) {
            $html = "";
            foreach ($this->_child as $child) {
                $html .= $child->toHtml();
            }
            return $html;
        }
        return isset($this->_child[$key]) ? $this->_child[$key]->toHtml() : "";
    }
    public function setTemplate($_template)
    {
        $this->_template = $_template;
        return $this;
    }
    public function getUrl($url = '')
    {

        if ($url == "") {
            return Mage::getBaseUrl();
        }
        $request = Mage::getModel('core/request');
        $_url = [];
        $url = explode('/', $url);
        $_url[] = $url[0] == '*' ? $request->getModuleName() : $url[0];
        $_url[] = $url[1] == '*' ? $request->getControllerName() : $url[1];
        $_url[] = $url[2] == '*' ? $request->getActionName() : $url[2];

        return Mage::getBaseUrl() . implode('/', $_url);
    }
    public function getLayout()
    {
        return Mage::getBlockSingleton('core/layout');
    }
    public function getrequest()
    {
        $model = Mage::getModel('core/request');
        return $model;
    }
    public function getMessage()
    {
        return Mage::getSingleton('core/messages');
    }
}
