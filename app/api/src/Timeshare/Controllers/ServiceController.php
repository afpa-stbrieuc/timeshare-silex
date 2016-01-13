<?php

namespace Timeshare\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Timeshare\Entities\Services;


class ServiceController {
    
    
     public function getService(Application $app)
    {
        return new JsonResponse($app['doctrine.odm.mongodb.dm']->getRepository('Timeshare\\Entities\\Services')->findAll());
      
    }
    
    public function addService(Application $app, Request $request){
        $dm = $app['doctrine.odm.mongodb.dm'];
        $payload = json_decode($request->getContent());
        $service = new Services($payload->name,
                                $payload->time,
                                $payload->note);

          $dm->persist($service);
          $dm->flush();

        return new JsonResponse($service, 201);
    }
    
    
    public function setTime($id, Application $app, Request $request){
        
        $dm = $app['doctrine.odm.mongodb.dm'];
        $service = $dm->getRepository('Timeshare\\Entities\\Services')->findOneBy(array('id' => $id));
        
        $payload = json_decode($request->getContent());
        
        $service->setTime($payload->time);
        $service->setNote($payload->note);
        $dm->flush($service);
        
        return new JsonResponse($service);
    }
    
}

