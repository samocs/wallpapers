<?php

class App
{
    public static function init(): void
    {
        // core
        require_once __DIR__ . '/Database.php';
        require_once __DIR__ . '/Helper.php';
        require_once __DIR__ . '/Redirect.php';
        require_once __DIR__ . '/Auth.php';

        // models
        require_once __DIR__ . '/../models/Contact.php';
        require_once __DIR__ . '/../models/Wallpaper.php';
    }
}