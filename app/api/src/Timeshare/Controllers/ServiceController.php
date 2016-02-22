<?php

namespace Timeshare\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Timeshare\Entities\Services;
use Timeshare\Entities\User;
use Timeshare\Entities\Annonce;

class ServiceController {
    
    //Affiche tous les services
     public function getService(Application $app)
    {
        return new JsonResponse($app['doctrine.odm.mongodb.dm']->getRepository('Timeshare\\Entities\\Services')->findAll());
      
    }
    
    //affiche un service en fonction  de son ID
    public function getOneService($id, Application $app)
    {
        $dm = $app['doctrine.odm.mongodb.dm'];
        $annonce = $dm->getRepository('Timeshare\\Entities\\Services')->findOneBy(array('id' => $id));
        if ($annonce !== NULL){
            return new JsonResponse($annonce);
        } 
        return new JsonResponse(404) ;
    }
    
    //delete a service
        public function deleteOneService($id, Application $app)
    {

        $dm = $app['doctrine.odm.mongodb.dm'];
        $annonce = $dm->getRepository('Timeshare\\Entities\\Services')->findOneBy(array('id' => $id));

        if ($annonce !== NULL) {
        	$dm->remove($annonce); 
	        $dm->flush();
	        return new JsonResponse(200);
        }

        return new JsonResponse(404);
    }
    
    //Ajout d'un service à la base de donnée
    public function addService(Application $app, Request $request){
        $dm = $app['doctrine.odm.mongodb.dm'];
        $payload = json_decode($request->getContent());
       
        $crediteur = $dm->getRepository('Timeshare\\Entities\\User')->findOneBy(array('id' => $payload->crediteur->id));
        $annonce = $dm->getRepository('Timeshare\\Entities\\Annonce')->findOneBy(array('id' => $payload->annonce->id));
                      
        $service = new Services(
                                $annonce->getUser(),
                                $crediteur,
                                $annonce,
                                $payload->note,
                                $payload->time
                                );

          $dm->persist($service);
          $dm->flush();

        return new JsonResponse($service, 201);
    }
   
    
    //Ajout de la durée d'un service rendu
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

