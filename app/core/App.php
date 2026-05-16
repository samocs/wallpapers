<?php

class App
{
    public static function init(): void
    {
        require_once __DIR__ . '/db.php';
        require_once __DIR__ . '/Helper.php';
        require_once __DIR__ . '/Redirect.php';
    }
}