<?php

class Core_Block_Template
{
    protected $_template;
    protected $_child = [];
    public function toHtml()
    {

        include_once(Mage::getBasedirectory() . 'App/design/frontend/template/' . $this->_template);
    }
    public function addChild($key, $block)
    {
        $this->_child[$key] = $block;
    }
    public function getChild($key)
    {
        return  isset($this->_child[$key]) ? $this->_child[$key] : "";
    }
    public function removeChild($key)
    {
        $this->_child[$key];
    }
    // public function getChildHtml($key)
    // {

    //     if ($key = '' && count($this->_child)) {
    //         $Html = '';
    //         foreach ($this->_child as $_child) {
    //             $Html .= $_child->_html;
    //         }
    //         return $Html;
    //     }
    //     return  isset($this->_child[$key]) ? $this->_child[$key]->toHtml() : "";
    // }

    public function getChildHtml($key)
    {
        if ($key == '' && count($this->_child)) {
            $html = "";
            foreach ($this->_child as $child) {
                $html .= $child->toHtml();
            }
            // print_r($html);
            return $html;
            // die();
        }
        return isset($this->_child[$key]) ? $this->_child[$key]->toHtml() : "";
        //return $this;

    }
    public function setTemplate($_template)
    {
        $this->_template = $_template;
        return $this;
    }
    public function getUrl($url)
    {

        $request = Mage::getModel('core/request');
        $_url = [];
        $url = explode('/', $url);
        $_url[] = $url[0] == '*' ? $request->getModuleName() : $url[0];
        $_url[] = $url[1] == '*' ? $request->getControllerName() : $url[1];
        $_url[] = $url[2] == '*' ? $request->getActionName() : $url[2];

        return Mage::getBaseUrl() . implode('/', $_url);
    }
}
