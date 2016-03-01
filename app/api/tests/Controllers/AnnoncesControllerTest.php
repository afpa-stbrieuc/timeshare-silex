<?php
namespace Timeshare\Tests;

use Silex\WebTestCase;
use Silex\Application;

use Timeshare\Entities\User;
use Timeshare\Entities\Annonce;


class AnnonceTest extends WebTestCase
{
    private $annonce;
    private $user;

    protected $app;

    //this will be called first creer l'application pour faire les tests
	public function createApplication()
    {
        
        $dbName = 'timeshare-test';

		$app = require __DIR__.'/../../config-init.php';

		$app['debug'] = true;

		// Generate raw exceptions instead of HTML pages if errors occur
		$app['exception_handler']->disable();


        $this->user = new User("prout","Zorro", "toto", "jean-claude", "14 rue des Girouettes", "langueux", "jc.toto@gmail.com");


        $this->app = $app;

		return $app;
    }


	public function testGetAll()
	{
	    $client = $this->createClient();
	    $crawler = $client->request('GET', '/api/annonces/');

	    //$payload = json_decode($client->getResponse()->getContent());
	    
	    $this->assertTrue($client->getResponse()->headers->contains(
        'Content-Type',
        'application/json'
    	));

	    $this->assertTrue($client->getResponse()->isOk());
    }


    public function testCRUD()
    {
        $client = $this->createClient();

        //create the user
        $dm = $this->app['doctrine.odm.mongodb.dm'];
        $dm->persist($this->user);
        $dm->flush();
        // create the advert
        $this->annonce = new Annonce('Pelouse tondre',
                                     $this->user,
                                     'blablablabla',
                                     \DateTime::createFromFormat('Y-m-d', '2016-03-17'),
                                     \DateTime::createFromFormat('Y-m-d', '2016-04-17'),
                                     'hennebont', 
                                     'jardinage',
                                     true);
        
        $resp = $client->request('POST', '/api/annonces/', array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode($this->annonce)  
            
        );
//        var_dump($this->annonce);
        
        //verif create
        $this->assertEquals($client->getResponse()->getStatusCode(), 201);
        $data = json_decode($client->getResponse()->getContent());

        //read + verif pour chaque attributs de Annonce:
        $this->assertEquals($this->annonce->getName(), $data->name);
//        $this->assertEquals($this->annonce->getDate(), \DateTime::createFromFormat('Y-m-d H:i:s', $data->date));
        $this->assertEquals($this->annonce->getDateValiditeDebut(), \DateTime::createFromFormat('Y-m-d', $data->dateValiditeDebut));
        $this->assertEquals($this->annonce->getDateValiditeFin(), \DateTime::createFromFormat('Y-m-d', $data->dateValiditeFin));
        $this->assertEquals($this->annonce->getUser()->getId(), $data->user->id);
        $this->assertEquals($this->annonce->getLocation(), $data->location);
        $this->assertEquals($this->annonce->getCategory(), $data->category);
        $this->assertEquals($this->annonce->getDemande(), $data->demande);
        $currentId = $data->id;

        //update
        $this->annonce->setName('mijo');


         $resp = $client->request('PUT', '/api/annonces/'.$currentId, array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode($this->annonce)
        );

        
       
        $this->assertEquals($client->getResponse()->getStatusCode(), 200);

        $data = json_decode($client->getResponse()->getContent());

        //verif update
        $this->assertEquals('mijo', $data->name);

        //delete
        $client = $this->createClient();
        $crawler = $client->request('DELETE', '/api/annonces/'.$currentId);
        //verif delete
        $this->assertEquals($client->getResponse()->getStatusCode(), 200);
    }

    public function testErrorForPayloadBlank() {
        
        $client = $this->createClient();
        
        //create the user
        $dm = $this->app['doctrine.odm.mongodb.dm'];
        $dm->persist($this->user);
        $dm->flush();
        // create the advert
        $this->annonce = new Annonce('',
                                     $this->user,
                                     'blablablabla',
                                     \DateTime::createFromFormat('Y-m-d H:i:s', '2016-01-17 19:37:00'),
                                     \DateTime::createFromFormat('Y-m-d H:i:s', '2016-02-17 19:37:00'),
                                     'hennebont', 
                                     'jardinage',
                                     true);
        
        $resp = $client->request('POST', '/api/annonces/', array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode($this->annonce)           
        );
        
        $this->assertEquals($client->getResponse()->getStatusCode(), 400);
        
        
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