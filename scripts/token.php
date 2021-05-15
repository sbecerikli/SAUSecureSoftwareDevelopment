<?php
class Token
{
    // Generates the CSRF token to be used in forms
    public static function generate()
    {       
        return $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
    }
    // Checks the POSTed CSRF token to ensure it matches, if it doesn't returns false
    public static function check($token)
    {
        if (isset($_SESSION['token']) && $token === $_SESSION['token']) {
           unset($_SESSION['token']);
            return true;
        } else {
            unset($_SESSION['token']);
            return false;
        }
    }
}