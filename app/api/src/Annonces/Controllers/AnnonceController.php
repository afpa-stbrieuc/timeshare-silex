<?php
namespace Annonces\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Annonces\Entities\Annonce;


class AnnonceController {



    public function getAllAction(Application $app)
    {
        return new JsonResponse($app['doctrine.odm.mongodb.dm']->getRepository('Annonces\\Entities\\Annonce')->findAll());
      
    }


    public function getOneAction($id, Application $app)
    {
        return new JsonResponse($app['doctrine.odm.mongodb.dm']->getRepository('Annonces\\Entities\\Annonce')->findOneBy(array('id' => $id)));
    }

    public function deleteOneAction($id, Application $app)
    {

        $dm = $app['doctrine.odm.mongodb.dm'];
        $annonce = $dm->getRepository('Annonces\\Entities\\Annonce')->findOneBy(array('id' => $id));
        $dm->remove($annonce); 
        $dm->flush();

        return new JsonResponse(200);
    }

    public function addOneAction(Application $app, Request $request)
    {
        $dm = $app['doctrine.odm.mongodb.dm'];
        $payload = json_decode($request->getContent());
        $annonce = new Annonce($payload->name);

          $dm->persist($annonce);
          $dm->flush();

        return new JsonResponse($annonce, 201);
    }

    public function editOneAction($id, Application $app, Request $request)
    {

        $dm = $app['doctrine.odm.mongodb.dm'];
        $annonce = $dm->getRepository('Annonces\\Entities\\Annonce')->findOneBy(array('id' => $id));
        $payload = json_decode($request->getContent());

        $annonce->setName($payload->name);
        $dm->flush($annonce);


        return new JsonResponse($annonce);
    }
}
