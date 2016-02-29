<?php

namespace Timeshare\Controllers;

//compenents qu'on a besoin
use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
//utiliser l'entite user dans Timeshare\Entities\User pour choper l'objet pour effectuer ce controller

// validator
use Symfony\Component\Validator\Constraints as Assert;

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
                        $payload->password,
                        $payload->surname,
                        $payload->firstname,
                        $payload->address,
                        $payload->town,
                        $payload->email);

        // errors for pseudo
        $errors = $app['validator']->validate($payload->pseudo, new Assert\Type('string'));
        if (count($errors) > 0) {
            return new JsonResponse ("Error: The pseudo must be a alphanumeric type" .$payload->pseudo, 400);
        }
        // errors for password
        $errors = $app['validator']->validate($payload->password, new Assert\Type('string'));
        if (count($errors) > 0) {
            return new JsonResponse ("Error: The password must be a alphanumeric type" .$payload->password, 400);
        }
        // errors for surname
        $errors = $app['validator']->validate($payload->surname, new Assert\Type('string'));
        if (count($errors) > 0) {
            return new JsonResponse ("Error: The surname must be a alphanumeric characters" .$payload->surname, 400);
        }
        // errors for firstname
        $errors = $app['validator']->validate($payload->firstname, new Assert\Type('string'));
        if (count($errors) > 0) {
            return new JsonResponse ("Error: The firstname must be a aphanumeric characters" .$payload->firstname, 400);          
        }
        // errors for address
        $errors = $app['validator']->validate($payload->address, new Assert\NotBlank);
        if (count($errors) > 0) {
            return new JsonResponse ("Error: The address is empty" .$payload->address, 400);
        }
        // errors for town
        $errors = $app['validator']->validate($payload->town, new Assert\Type('string'));
        if (count($errors) > 0) {
            return new JsonResponse ("Error: The town must be a alphanumeric characters" .$payload->town, 400);
        }
        // errors for email
        $errors = $app['validator']->validate($payload->email, new Assert\Email);
        if (count($errors) >0 ) {
            return new JsonResponse ("Error: The email is not valid" .$payload->email, 400);
        }
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
        $user->setPassword($payload->password);
        $dm->flush($user);

        return new JsonResponse($user);
    }

    public function userAuthentication(Application $app, Request $request)
    {
        $dm = $app['doctrine.odm.mongodb.dm'];
        $payload = json_decode($request->getContent());
        //check credentials
        $user = $dm->getRepository('Timeshare\\Entities\\User')->findOneBy(array('email' => $payload->email));
        $passLogin = $payload->password;
        $passdB = $user->getPassword();

        if ($passLogin === $passdB){
            return new JsonResponse($user, 200);
            var_dump($user);
        }else{
             return new JsonResponse('Login error', 400);
        }
    }

}
