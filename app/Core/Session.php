<?php
/**
 * User: Moxie5
 * Author: Dobromir Dobrev
 * Created with educational purposes 
 */

namespace App\Core;

class Session
{
    protected const FKEY = 'flash_message';
    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FKEY] ?? [];
        foreach ($flashMessages as $key => &$message) {
            $message['remove'] = true;
        }

        $_SESSION[self::FKEY] = $flashMessages;
    }

    public function setSession($key, $data)
    {
        $_SESSION[$key] = [
            'value' => $data
        ];
    }

    public function getSession($key)
    {
        return $_SESSION[$key]['value'] ?? false;
    }

    public function closeSession()
    {
        // unset($key);
        session_unset();
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FKEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FKEY][$key]['value'] ?? false;
    }

    public function set_csrf()
    {
        $csrf_token = bin2hex(random_bytes(25));
        $_SESSION['csrf'] = $csrf_token;
        echo '<input type="hidden" name="csrf" value="' . $csrf_token . '">';
    }
    public function is_csrf_valid()
    {
        if (!isset($_SESSION['csrf']) || !isset($_POST['csrf'])) {
            return false;
        }
        if ($_SESSION['csrf'] != $_POST['csrf']) {
            return false;
        }
        return true;
    }

    public function __destruct()
    {
        // Remove Flash messages
        $flashMessages = $_SESSION[self::FKEY] ?? [];
        foreach ($flashMessages as $key => &$message) {
            if ($message['remove']) {
                unset($flashMessages[$key]);
            }
        }

        $_SESSION[self::FKEY] = $flashMessages;
    }
}
