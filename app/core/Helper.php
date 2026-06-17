<?php

class Helper
{
    public static function getPageTitle(): string
    {
        $script = $_SERVER['SCRIPT_NAME'];
        $page = ucfirst(basename($script, '.php'));
        return 'Wallpaper Hub - ' . $page;
    }
    public static function e(string $s): string
    {
        return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}
class Redirect{
    public static function redirect(string $url):void{
        header('Location: '.$url);
        exit;
    }
}