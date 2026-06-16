<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/../../app/core/App.php';
App::init();

Auth::logout();

header('Location: login.php');
exit;