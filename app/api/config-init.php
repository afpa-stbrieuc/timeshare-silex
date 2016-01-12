<?php


require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;

use Neutron\Silex\Provider\MongoDBODMServiceProvider;


$app = new Silex\Application();


//serve index as default
$app->get('/', function () use ($app) {
    return $app->sendFile(dirname(__DIR__).'/index.html');
 });


//load routes from config/routes.yml
$app['routes'] = $app->extend(
    'routes',
    function (RouteCollection $routes, Silex\Application $app) {
        $loader     = new YamlFileLoader(new FileLocator(__DIR__ . '/config'));
        $collection = $loader->load('routes.yml');
        $routes->addCollection($collection);

        return $routes;
    }
);



//register logger
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/log/dev.log',
    //TODO uotput to console in dev mode
));


if (!isset($dbName)) {
    $app['monolog']->addInfo("dbName is null!!!!!");
    exit();
}

//mongo connection & ODM
$app->register(new MongoDBODMServiceProvider(), array(
    'doctrine.odm.mongodb.connection_options' => array(
        'database' => $dbName,

        // connection string:
        // mongodb://[username:password@]host1[:port1][,host2[:port2:],...]/db
        'host'     => 'localhost',

        // connection options as described here:
        // http://www.php.net/manual/en/mongoclient.construct.php
        'options'  => array('fsync' => false)
    ),
    'doctrine.odm.mongodb.documents'               => array(
        0 => array(
            'type' => 'annotation',
            'path' => array(
                 'src/Todos/Entities'
            ),
            'namespace' => 'Todos\Entities',
            'alias'     => 'docs',
        ),
    ),
    'doctrine.odm.mongodb.proxies_dir'             => 'cache/doctrine/odm/mongodb/Proxy',
    'doctrine.odm.mongodb.proxies_namespace'       => 'DoctrineMongoDBProxy',
    'doctrine.odm.mongodb.auto_generate_proxies'   => true,
    'doctrine.odm.mongodb.hydrators_dir'           => 'cache/doctrine/odm/mongodb/Hydrator',
    'doctrine.odm.mongodb.hydrators_namespace'     => 'DoctrineMongoDBHydrator',
    'doctrine.odm.mongodb.auto_generate_hydrators' => true,
    'doctrine.odm.mongodb.metadata_cache'          => new \Doctrine\Common\Cache\ArrayCache(),
    'doctrine.odm.mongodb.logger_callable'         => $app->protect(function($query) {
                                                          // log your query
                                                      }),
) );

//register all entities
// $app->register(new MongoDBODMServiceProvider(), array(
//     // ...
//     'doctrine.odm.mongodb.documents' => array(
//         0 => array(
//             'type' => 'annotation',
//             'path' => array(
//                  'src/Todos/Entities'
//             ),
//             'namespace' => 'Todos\Entities',
//             'alias'     => 'docs',
//         ),
//     ),
//     // ...
// ));




return $app;

//$app->run();