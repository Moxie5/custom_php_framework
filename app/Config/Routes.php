<?php 

/**========================================= 
*                   ROUTES 
* =========================================*/

$app->router->add('/', [App\Controllers\Home::class, 'index']);
$app->router->add('/about', [App\Controllers\About\About::class, 'about']);