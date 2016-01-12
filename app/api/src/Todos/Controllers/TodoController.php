<?php
namespace Todos\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Todos\Entities\Todo;


class TodoController {



    public function getAllAction(Application $app)
    {
        return new JsonResponse($app['doctrine.odm.mongodb.dm']->getRepository('Todos\\Entities\\Todo')->findAll());
      
    }


    public function getOneAction($id, Application $app)
    {
        return new JsonResponse($app['doctrine.odm.mongodb.dm']->getRepository('Todos\\Entities\\Todo')->findOneBy(array('id' => $id)));
    }

    public function deleteOneAction($id, Application $app)
    {

        $dm = $app['doctrine.odm.mongodb.dm'];
        $todo = $dm->getRepository('Todos\\Entities\\Todo')->findOneBy(array('id' => $id));
        $dm->remove($todo); 
        $dm->flush();

        return new JsonResponse(200);
    }

    public function addOneAction(Application $app, Request $request)
    {
        $dm = $app['doctrine.odm.mongodb.dm'];
        $payload = json_decode($request->getContent());
        $todo = new Todo($payload->name);

          $dm->persist($todo);
          $dm->flush();

        return new JsonResponse($todo, 201);
    }

    public function editOneAction($id, Application $app, Request $request)
    {

        $dm = $app['doctrine.odm.mongodb.dm'];
        $todo = $dm->getRepository('Todos\\Entities\\Todo')->findOneBy(array('id' => $id));
        $payload = json_decode($request->getContent());

        $todo->setName($payload->name);
        $dm->flush($todo);


        return new JsonResponse($todo);
    }
}
