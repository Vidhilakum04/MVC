<?php

class Core_Model_Messages extends Core_Model_Session
{

    public function addMessages() {}
    public function addError($message)
    {
        $messages = $this->get('messages') ?: [];
        $messages['error'][] = $message;
        $this->set('messages', $messages);
        return $this;
    }
    public function getError()
    {
        $message = $this->get('messages');
        $error = isset($message['error']) ? $message['error'] : [];
        unset($message['error']);
        $this->set('messages', $message);
        return $error;
    }

    public function addSuccess($message)
    {
        $messages = $this->get('messages') ?: [];
        $messages['success'][] = $message;
        $this->set('messages', $messages);
        return $this;
    }
    public function getSuccess()
    {
        $message = $this->get('messages');
        $success = isset($message['success']) ? $message['success'] : [];
        unset($message['success']);
        $this->set('messages', $message);
        return $success;
    }
    public function addWarning($message)
    {
        $messages = $this->get('messages') ?: [];
        $messages['warning'][] = $message;
        $this->set('messages', $messages);
        return $this;
    }
    public function getWarning()
    {
        $message = $this->get('messages');
        $warning = isset($message['warning']) ? $message['warning'] : [];
        unset($message['warning']);
        $this->set('messages', $message);
        return $warning;
    }
}
