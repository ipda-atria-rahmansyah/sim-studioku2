<?php

class AuthMiddleware
{
    public static function check()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['id_user'])) {

            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public static function admin()
    {
        self::check();

        if ($_SESSION['role'] != 'admin') {

            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }
    }

    public static function customer()
    {
        self::check();

        if ($_SESSION['role'] != 'customer') {

            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }
    }
}