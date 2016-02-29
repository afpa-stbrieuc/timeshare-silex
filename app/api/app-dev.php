<?php
//timeshare use config file
$dbName = 'timeshare';

//Allow PHP's built-in server to serve our static content 
$filename = dirname(__DIR__).'/public'.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

$app = require __DIR__.'/config-init.php';
$app['debug'] = true;

//debug routes
foreach ($app['routes'] as $name => $route) {
    $requirements = array();
    foreach ($route->getRequirements() as $key => $requirement) {
        $requirements[] = $key . ' => ' . $requirement;
    }

    $r=  $name.'=>'.$route->getPath().' '.join(', ', $requirements);
    $app['monolog']->addInfo($r);
}






$app['monolog']->addInfo("server loaded");

$app->run();
