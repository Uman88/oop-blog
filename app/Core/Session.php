<?php

namespace App\Core;

class Session
{
    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    public static function setAlert($alert, $type)
    {
        return $_SESSION[$alert] = $type;
    }

    public static function getAlert($alert)
    {
        if (isset($_SESSION[$alert])) {
            return $_SESSION[$alert];
        }
    }

    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public static function destroy()
    {
        session_destroy();
    }
}