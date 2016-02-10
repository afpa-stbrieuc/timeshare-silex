<?php

namespace Timeshare\Controllers;

//compenents qu'on a besoin
use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
//utiliser l'entite user dans Timeshare\Entities\User pour choper l'objet pour effectuer ce controller

use Timeshare\Entities\User;




class UserController {



    public function getAllUser(Application $app)
    {
        return new JsonResponse($app['doctrine.odm.mongodb.dm']->getRepository('Timeshare\\Entities\\User')->findAll());
    }

    public function getOneUser($id, Application $app)
    {
        return new JsonResponse($app['doctrine.odm.mongodb.dm']->getRepository('Timeshare\\Entities\\User')->findOneBy(array('id' => $id)));
    }

    public function deleteOneUser($id, Application $app)
    {

        $dm = $app['doctrine.odm.mongodb.dm'];
        $user = $dm->getRepository('Timeshare\\Entities\\User')->findOneBy(array('id' => $id));
        $dm->remove($user); 
        $dm->flush();

        return new JsonResponse(200);
    }

    public function addOneUser(Application $app, Request $request)
    {
        $dm = $app['doctrine.odm.mongodb.dm'];
        $payload = json_decode($request->getContent());
        $user = new User($payload->pseudo,
                        $payload->surname,
                        $payload->firstname,
                        $payload->address,
                        $payload->town,
                        $payload->timebalance,
                        $payload->email);

          $dm->persist($user);
          $dm->flush();

        return new JsonResponse($user, 201);
    }

    public function editOneUser($id, Application $app, Request $request)
    {

        $dm = $app['doctrine.odm.mongodb.dm'];
        $user = $dm->getRepository('Timeshare\\Entities\\User')->findOneBy(array('id' => $id));
        $payload = json_decode($request->getContent());

        $user->setPseudo($payload->pseudo);
        $user->setFirstname($payload->firstname);
        $user->setSurname($payload->surname);
        $user->setAddress($payload->address);
        $user->setTown($payload->town);
        $user->setTimeBalance($payload->timebalance);
        $user->setEmail($payload->email);
        $dm->flush($user);

        return new JsonResponse($user);
    }
}
