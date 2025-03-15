<?php
class Core_Model_Session
{
    public function __construct()
    {
        @session_start(); // initializes or resumes an existing session.
        //If a session doesn't exist, PHP creates a new session and assigns a unique session ID.
    }
    public function getId()
    {
        return session_id();
        //session_id() returns the current session's unique ID.
        // This ID is used to identify the session across multiple page loads.
    }
    public function set($key, $value)
    {
        $_SESSION[$key] = $value; //The $key is the session variable name, and $value is the data stored.
    }
    public function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
    public function remove($key)
    {
        if (isset($_SESSION[$key])) {

            unset($_SESSION[$key]);
        }
    }
}
