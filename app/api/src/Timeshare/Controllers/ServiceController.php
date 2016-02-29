<?php

namespace Timeshare\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

// validator
use Symfony\Component\Validator\Constraints as Assert;

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
        
        // errors for user
        $errors = $app['validator']->validate($service->getDebiteur(), new Assert\NotBlank);
        if (count($errors) > 0) {
            return new JsonResponse ("Error: The user is empty" .$service->getDebiteur(), 400);
        }
        
        // errors for crediteur
        $errors = $app['validator']->validate($service->getCrediteur(), new Assert\NotBlank);
        if (count($errors) > 0) {
            return new JsonResponse ("Error: The crediteur is empty" .$service->getCrediteur(), 400);
        }
        
        // errors for annonce
        $errors = $app['validator']->validate($service->getAnnonce(), new Assert\NotBlank);
        if (count($errors) > 0) {
            return new JsonResponse ("Error: The annonce is empty" .$service->getAnnonce(), 400);
        }
        
        // errors for note
        $errors = $app['validator']->validate($service->getNote(), new Assert\Type('integer'));
        if (count($errors) > 0) {
            return new JsonResponse ("Error: The note must be a number" .$service->getNote(), 400);
        }
        
        // errors for time
        $erros  = $app['validator']->validate($service->getTime(), new Assert\DateTime);
        if (count($errors) > 0) {
            return new JsonResponse ("Error: The time must be a DateTime type" .$service->getTime(), 400);
        }
        
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

