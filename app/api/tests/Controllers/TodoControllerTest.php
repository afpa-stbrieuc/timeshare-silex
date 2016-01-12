<?php
namespace Todo\Tests;

use Silex\WebTestCase;
use Silex\Application;

class TodoTest extends WebTestCase
{





	public function createApplication()
    {
        
        $dbName = 'todos-test';

		$app = require __DIR__.'/../../config-init.php';

		$app['debug'] = true;


		// Generate raw exceptions instead of HTML pages if errors occur
		$app['exception_handler']->disable();

		return $app;



	 //    return $app;
    }


	public function testGetAll()
	{
	    $client = $this->createClient();
	    $crawler = $client->request('GET', '/api/todos/');

	    //$payload = json_decode($client->getResponse()->getContent());
	    

	    $this->assertTrue($client->getResponse()->headers->contains(
        'Content-Type',
        'application/json'
    	));

	    $this->assertTrue($client->getResponse()->isOk());

    }

    

    public function testAddUpdateDelete(){


    	$client = $this->createClient();

        // $client->request(
        //     'POST',
        //     '/api/todos/',
        //     array('name' => 'kikou')
        // );
    	$resp = $client->request('POST', '/api/todos/', array(),
        	array(),
        	array('CONTENT_TYPE' => 'application/json'),
        	'{"name":"kikou"}');

    	$this->assertEquals($client->getResponse()->getStatusCode(), 201);

    	$data = json_decode($client->getResponse()->getContent());


    	$this->assertEquals('kikou', $data->name);

    	$id = $data->id;

    	//update

    	$resp = $client->request('PUT', '/api/todos/'.$id, array(),
        	array(),
        	array('CONTENT_TYPE' => 'application/json'),
        	'{"name":"mijo"}');
        // $client->request(
        //     'PUT',
        //     '/api/todos/'.$id,
        //     array('name' => 'mijo')
        // );

    	$this->assertEquals($client->getResponse()->getStatusCode(), 200);

    	$data = json_decode($client->getResponse()->getContent());


    	$this->assertEquals('mijo', $data->name);

    	//delete
    	$client = $this->createClient();
   		$crawler = $client->request('DELETE', '/api/todos/'.$id);
   		$this->assertEquals($client->getResponse()->getStatusCode(), 200);





    }

   



}