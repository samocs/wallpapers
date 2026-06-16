<?php

class Helper
{
    public static function getPageTitle(): string
    {
        $script = $_SERVER['SCRIPT_NAME'];
        $page = ucfirst(basename($script, '.php'));
        return 'Wallpaper Hub - ' . $page;
    }
}
class Redirect{
    public static function redirect(string $url):void{
        header('Location: '.$url);
        exit;
    }
}