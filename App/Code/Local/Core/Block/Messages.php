<?php

class Core_Block_Messages extends Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('page/messages.phtml');
    }
    public function getError()
    {
        // echo "12";
        return $this->getMessage()->getError();
        // die; //core/template model of core/msg
    }
    public function getSuccess()
    {
        return $this->getMessage()->getSuccess();
    }
    public function getWarning()
    {
        return $this->getMessage()->getWarning();
    }
}
