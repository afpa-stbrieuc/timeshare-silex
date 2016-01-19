<?php
namespace Timeshare\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Timeshare\Entities\Annonce;
use Timeshare\Entities\User;


class AnnonceController {


    public function getAllAction(Application $app)
    {
        return new JsonResponse($app['doctrine.odm.mongodb.dm']->getRepository('Timeshare\\Entities\\Annonce')->findAll());
    }

    public function getOneAction($id, Application $app)
    {
        return new JsonResponse($app['doctrine.odm.mongodb.dm']->getRepository('Timeshare\\Entities\\Annonce')->findOneBy(array('id' => $id)));
    }

    public function deleteOneAction($id, Application $app)
    {

        $dm = $app['doctrine.odm.mongodb.dm'];
        $annonce = $dm->getRepository('Timeshare\\Entities\\Annonce')->findOneBy(array('id' => $id));

        if ($annonce !== NULL) {
        	$dm->remove($annonce); 
	        $dm->flush();
	        return new JsonResponse(200);
        }

        return new JsonResponse(300);
    }

    public function addOneAction(Application $app, Request $request)
    {
        $dm = $app['doctrine.odm.mongodb.dm'];
        $payload = json_decode($request->getContent());
        $user = $dm->getRepository('Timeshare\\Entities\\User')->findOneBy(array('id' => $payload->user));
        if ($user === NULL) {
            return new JsonResponse("Error: Can't find user ".$payload->user, 500);
        }
        $annonce = new Annonce(
        		$payload->name,
        		$user, 
        		new \DateTime($payload->date_validite_debut),
        		new \DateTime($payload->date_validite_fin),
        		$payload->location,
        		$payload->category,
        		$payload->demande);

          $dm->persist($annonce);
          $dm->flush();

        return new JsonResponse($annonce, 201);
    }

    public function editOneAction($id, Application $app, Request $request)
    {

        $dm = $app['doctrine.odm.mongodb.dm'];
        $annonce = $dm->getRepository('Timeshare\\Entities\\Annonce')->findOneBy(array('id' => $id));
        $payload = json_decode($request->getContent());

        $annonce->setName($payload->name);
        $user = $dm->getRepository('Timeshare\\Entities\\User')->findOneBy(array('id' => $payload->user));
        $annonce->setUser($user);
        $annonce->setDemande($payload->demande);
        $annonce->setDateValiditeDebut(new \DateTime($payload->date_validite_debut));
        $annonce->setDateValiditeFin(new \DateTime($payload->date_validite_fin));
        $annonce->setLocation($payload->location);
        $annonce->setcategory($payload->category);
        $dm->flush($annonce);

        return new JsonResponse($annonce);
    }
}
