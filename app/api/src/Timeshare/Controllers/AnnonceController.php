<?php
namespace Timeshare\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

// validator
use Symfony\Component\Validator\Constraints as Assert;

use Timeshare\Entities\Annonce;
use Timeshare\Entities\User;


class AnnonceController {


    public function getAllAction(Application $app, Request $request)
    {
        $userId = $request->get('userId');
        $filter = array();
        if ($userId !== null ){
            $filter['user'] = $userId;
        }
        else{
            $filter['demande'] = true;
        }
        
        return new JsonResponse($app['doctrine.odm.mongodb.dm']->getRepository('Timeshare\\Entities\\Annonce')->findby($filter));
    }
    

    
    public function getOffers(Application $app){
        
        
        return new JsonResponse($app['doctrine.odm.mongodb.dm']->getRepository('Timeshare\\Entities\\Annonce')->findBy(array('demande' => false)));
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
        
        // error if $payload is blank
        $errors = $app['validator']->validate($payload, new Assert\NotBlank);
        if (count($errors) > 0 ) {
            return new JsonResponse ("{Error: Annonces is empty (Bad Gateway) ".$payload."}", 400);
        }
        
        $user = $dm->getRepository('Timeshare\\Entities\\User')->findOneBy(array('id' => $payload->user->id));        
        // errors gestion for user
        if ($user === NULL) {
            return new JsonResponse("{Error: Can't find user ".$payload->user."}", 404);
        }
        
        $annonce = new Annonce(
            $payload->name,
            $user, 
            $payload->description,
            new \DateTime($payload->dateValiditeDebut),
            new \DateTime($payload->dateValiditeFin),
            $payload->location,
            $payload->category,
            $payload->demande);

        // errors for name of annonce
        $errors = $app['validator']->validate($payload->name, new Assert\NotBlank);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The name of annonce is empty ".$payload->name."}", 400);
        }
        $errors = $app['validator']->validate(gettype($payload->name), new Assert\Type('string'));
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The name must be a alphanumeric characters ".$payload->name."}", 400);
        }
        
        // errors for description of annonce
        $errors = $app['validator']->validate($payload->description, new Assert\NotBlank);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The description of the annonce is empty ".$payload->description."}", 400);
        }
        $errors = $app['validator']->validate(gettype($payload->description), new Assert\Type('string'));
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The description must be a alphanumerics charracters ".$payload->description."}", 400);        
        }
        
        // errors for dateValiditeDebut
        $errors = $app['validator']->validate($payload->dateValiditeDebut, new Assert\NotBlank);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The dateValiditeDebut is empty ".$payload->dateValiditeDebut."}", 400);
        }
        $errors = $app['validator']->validate($payload->dateValiditeDebut, new Assert\Date);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The dateValiditeDebut must be a DateTime type ".$payload->dateValiditeDebut."}", 400);
        }
        
        // errors for dateValiditeFin
        $errors = $app['validator']->validate($payload->dateValiditeFin, new Assert\NotBlank);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The dateValiditeFin is empty ".$payload->dateValiditeFin."}", 400);
        }
        $errors = $app['validator']->validate($payload->dateValiditeFin, new Assert\Date);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The dateValiditeFin must be a DateTime type ".$payload->dateValiditeFin."}", 400);
        }
        
        // errors for location
        $errors = $app['validator']->validate($payload->location, new Assert\NotBlank);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The location is empty ".$payload->location."}", 400);
        }
        $errors = $app['validator']->validate($payload->location, new Assert\Type('string'));
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The location must be a string type ".$payload->location."}", 400);
        }
        
        // errors for category
        $errors = $app['validator']->validate($payload->category, new Assert\NotBlank);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The category is empty ".$payload->category."}", 400);
        }
        $errors = $app['validator']->validate($payload->category, new Assert\Type('string'));
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The category must be a string type ".$payload->category."}", 400);
        }
        
        // errors for demande
        $errors = $app['validator']->validate($payload->demande, new Assert\NotNull);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The demande is empty ".$payload->demande."}", 400);
        }
        $errors = $app['validator']->validate($payload->demande, new Assert\Type('boolean'));
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The demande must be a boolean type ".$payload->demande."}", 400);
        }
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
        $annonce->setDescription($payload->description);
        $user = $dm->getRepository('Timeshare\\Entities\\User')->findOneBy(array('id' => $payload->user));
        $annonce->setUser($user);
        $annonce->setDemande($payload->demande);
        $annonce->setDateValiditeDebut(new \DateTime($payload->dateValiditeDebut));
        $annonce->setDateValiditeFin(new \DateTime($payload->dateValiditeFin));
        $annonce->setLocation($payload->location);
        $annonce->setCategory($payload->category);
        
                // errors for name of annonce
        $errors = $app['validator']->validate($payload->name, new Assert\NotBlank);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The name of annonce is empty ".$payload->name."}", 400);
        }
        $errors = $app['validator']->validate(gettype($payload->name), new Assert\Type('string'));
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The name must be a alphanumeric characters ".$payload->name."}", 400);
        }
        
        // errors for description of annonce
        $errors = $app['validator']->validate($payload->description, new Assert\NotBlank);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The description of the annonce is empty ".$payload->description."}", 400);
        }
        $errors = $app['validator']->validate(gettype($payload->description), new Assert\Type('string'));
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The description must be a alphanumerics characters ".$payload->description."}", 400);        
        }
        
        // errors for dateValiditeDebut
        $errors = $app['validator']->validate($payload->dateValiditeDebut, new Assert\NotBlank);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The dateValiditeDebut is empty ".$payload->dateValiditeDebut."}", 400);
        }
        $errors = $app['validator']->validate($payload->dateValiditeDebut, new Assert\Date);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The dateValiditeDebut must be a DateTime type ".$payload->dateValiditeDebut."}", 400);
        }
        
        // errors for dateValiditeFin
        $errors = $app['validator']->validate($payload->dateValiditeFin, new Assert\NotBlank);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The dateValiditeFin is empty ".$payload->dateValiditeFin."}", 400);
        }
        $errors = $app['validator']->validate($payload->dateValiditeFin, new Assert\Date);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The dateValiditeFin must be a DateTime type ".$payload->dateValiditeFin."}", 400);
        }
        
        // errors for location
        $errors = $app['validator']->validate($payload->location, new Assert\NotBlank);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The location is empty ".$payload->location."}", 400);
        }
        $errors = $app['validator']->validate($payload->location, new Assert\Type('string'));
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The location must be a string type ".$payload->location."}", 400);
        }
        
        // errors for category
        $errors = $app['validator']->validate($payload->category, new Assert\NotBlank);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The category is empty ".$payload->category."}", 400);
        }
        $errors = $app['validator']->validate($payload->category, new Assert\Type('string'));
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The category must be a string type ".$payload->category."}", 400);
        }
        
        // errors for demande
        $errors = $app['validator']->validate($payload->demande, new Assert\NotNull);
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The demande is empty ".$payload->demande."}", 400);
        }
        $errors = $app['validator']->validate($payload->demande, new Assert\Type('boolean'));
        if (count($errors) > 0) {
            return new JsonResponse ("{Error: The demande must be a boolean type ".$payload->demande."}", 400);
        }
        
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
        public function getAllLocation(Application $app){
        
       $dm = $app['doctrine.odm.mongodb.dm'];
       $category = $dm->createQueryBuilder('Timeshare\\Entities\\Annonce')
        ->distinct('location')
        ->getQuery()
        ->execute();
       //var_dump($category);
       
        return new JsonResponse(iterator_to_array($category, false));

        
    }
    
    public function sortAnnonce($category,$lieu,Application $app){

        $annonce = ($app['doctrine.odm.mongodb.dm']->getRepository('Timeshare\\Entities\\Annonce')->findBy(array('category' => $category,'location' => $lieu,'demande' => true )));
        $user = array();
        foreach ($annonce as $value) {
            $user[] = $value->getUser();
        }
        
      
        
        return new JsonResponse ($annonce);
    }
    
        public function sortOffer($category,$lieu,Application $app){

        $annonce = ($app['doctrine.odm.mongodb.dm']->getRepository('Timeshare\\Entities\\Annonce')->findBy(array('category' => $category,'location' => $lieu, 'demande' => false)));
        $user = array();
        foreach ($annonce as $value) {
            $user[] = $value->getUser();
        }
        
      
        
        return new JsonResponse ($annonce);
    }

}
