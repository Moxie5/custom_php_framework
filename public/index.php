<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('APPPATH', dirname(__DIR__) . '/app/');
//Simple debug
function debug($str)
{
    echo "<pre>";
    var_dump($str);
    echo "</pre>";
}

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Core;

$app = new Core();

$app->router->add('/', [App\Controllers\Home::class, 'index']);
$app->router->add('/about', [App\Controllers\About\About::class, 'about']);

$app->run();
