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

        return new JsonResponse(404);
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
        		new \DateTime($payload->dateValiditeDebut),
        		new \DateTime($payload->dateValiditeFin),
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
        $annonce->setDateValiditeDebut(new \DateTime($payload->dateValiditeDebut));
        $annonce->setDateValiditeFin(new \DateTime($payload->dateValiditeFin));
        $annonce->setLocation($payload->location);
        $annonce->setCategory($payload->category);
        $dm->flush($annonce);

        return new JsonResponse($annonce);
    }
    
    public function getAllCat(Application $app){
        
       $dm = $app['doctrine.odm.mongodb.dm'];
       $category = $dm->createQueryBuilder('Timeshare\\Entities\\Annonce')
        ->distinct('category')
        ->getQuery()
        ->execute();
       //var_dump($category);
       
        return new JsonResponse(iterator_to_array($category, false));

        
    }
}
