<?php
/**
 * User: Moxie5
 * Author: Dobromir Dobrev
 * Created with educational purposes 
 */
/**
 * Disable errors 
 * ini_set('display_errors', 0);
 * ini_set('display_startup_errors', 0);
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('APPPATH', dirname(__DIR__) . '/app/');
define('BASEPATH', dirname(__DIR__) . '/');

//Simple debug
function debug($str)
{
    echo "<pre>";
    var_dump($str);
    echo "</pre>";
}

use App\Core\Core;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASEPATH);
$dotenv->load();

$app = new Core();

require_once __DIR__ . '/../app/Config/Routes.php';

$app->run();
