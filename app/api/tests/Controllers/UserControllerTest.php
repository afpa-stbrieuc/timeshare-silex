<?php
namespace Timeshare\Tests;

use Silex\WebTestCase;
use Silex\Application;

use Timeshare\Entities\User;

class UserTest extends WebTestCase
{

    private $user;

    //this will be called first
	public function createApplication()
    {
        
        $dbName = 'timeshare-test';

		$app = require __DIR__.'/../../config-init.php';

		$app['debug'] = true;

		// Generate raw exceptions instead of HTML pages if errors occur
		$app['exception_handler']->disable();

        $this->user = new User('Zorro', 'mot de passe', 'Des Bois', 'Toto', '1450 Madison  Square', 'Singapour', 200, 'zorro@gmail.com');

		return $app;

	 //    return $app;
    }


	public function testGetAll()
	{
	    $client = $this->createClient();
	    $crawler = $client->request('GET', '/api/user/');

	    //$payload = json_decode($client->getResponse()->getContent());
	    
	    $this->assertTrue($client->getResponse()->headers->contains(
        'Content-Type',
        'application/json'
    	));

	    $this->assertTrue($client->getResponse()->isOk());

    }


    public function testCRUD(){
        $client = $this->createClient();


        $resp = $client->request('POST', '/api/user/', array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode($this->user)
        );

        $this->assertEquals($client->getResponse()->getStatusCode(), 201);

        $data = json_decode($client->getResponse()->getContent());


        $this->assertEquals($this->user->getSurname(), $data->surname);

        $currentId= $data->id;

        //update
        $this->user->setSurname('mijo');

         $resp = $client->request('PUT', '/api/user/'.$currentId, array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode($this->user)
        );
        

        $this->assertEquals($client->getResponse()->getStatusCode(), 200);

        $data = json_decode($client->getResponse()->getContent());

        $this->assertEquals('mijo', $data->surname);

        //delete
        $client = $this->createClient();
        $crawler = $client->request('DELETE', '/api/user/'.$currentId);
        $this->assertEquals($client->getResponse()->getStatusCode(), 200);

    }

    // public function testAddUpdateDelete(){


    // 	$client = $this->createClient();

    //     // $client->request(
    //     //     'POST',
    //     //     '/api/todos/',
    //     //     array('name' => 'kikou')
    //     // );
    // 	$resp = $client->request('POST', '/api/annonces/', array(),
    //     	array(),
    //     	array('CONTENT_TYPE' => 'application/json'),
    //     	'{"name":"kikou"}');

    // 	$this->assertEquals($client->getResponse()->getStatusCode(), 201);

    // 	$data = json_decode($client->getResponse()->getContent());


    // 	$this->assertEquals('kikou', $data->name);

    // 	$id = $data->id;

    // 	//update

    

    // 	//delete
    // 	$client = $this->createClient();
   	// 	$crawler = $client->request('DELETE', '/api/annonces/'.$id);
   	// 	$this->assertEquals($client->getResponse()->getStatusCode(), 200);





    // }

   



}