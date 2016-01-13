<?php
//TODO use config file
$dbName = 'timeshare';

$app = require __DIR__.'/config-init.php';
$app['debug'] = true;


//Allow PHP's built-in server to serve our static content 
$filename = dirname(__DIR__).preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}



$app['monolog']->addInfo("server loaded");

$app->run();