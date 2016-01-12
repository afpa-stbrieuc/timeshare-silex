<?php
$dbName = 'todos';

$app = require __DIR__.'/config-init.php';


$app['monolog']->addInfo("server loaded");

$app->run();