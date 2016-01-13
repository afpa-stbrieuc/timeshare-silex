<?php

namespace Timeshare\Controllers;

#compenents qu'on a besoin
use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
#utiliser l'entite user dans Timeshare\Entities\User pour choper l'objet pour effectuer ce controller
use Timeshare\Entities\User;




class UserController {



    public function getAllAction(Application $app)
    {
        return new JsonResponse($app['doctrine.odm.mongodb.dm']->getRepository('Timeshare\\Entities\\User')->findAll());
      
    }


    // public function getOneAction($id, Application $app)
    // {
    //     return new JsonResponse($app['doctrine.odm.mongodb.dm']->getRepository('Timeshare\\Entities\\User')->findOneBy(array('id' => $id)));
    // }

    // public function deleteOneAction($id, Application $app)
    // {

    //     $dm = $app['doctrine.odm.mongodb.dm'];
    //     $user = $dm->getRepository('Timeshare\\Entities\\User')->findOneBy(array('id' => $id));
    //     $dm->remove($user); 
    //     $dm->flush();

    //     return new JsonResponse(200);
    // }

    // public function addOneAction(Application $app, Request $request)
    // {
    //     $dm = $app['doctrine.odm.mongodb.dm'];
    //     $payload = json_decode($request->getContent());
    //     $user = new User($payload->name);

    //       $dm->persist($user);
    //       $dm->flush();

    //     return new JsonResponse($user, 201);
    }

    // public function editOneAction($id, Application $app, Request $request)
    // {

    //     $dm = $app['doctrine.odm.mongodb.dm'];
    //     $user = $dm->getRepository('Timeshare\\Entities\\User')->findOneBy(array('id' => $id));
    //     $payload = json_decode($request->getContent());

    //     $user->setName($payload->name);
    //     $dm->flush($user);


    //     return new JsonResponse($user);
    // }
}
