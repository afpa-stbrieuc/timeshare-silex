<?php
namespace Timeshare\Tests;

use Silex\WebTestCase;
use Silex\Application;

use Timeshare\Entities\User;
use Timeshare\Entities\Annonce;
use Timeshare\Entities\Services;


class ServicesTest extends WebTestCase
{
    private $service;
    private $annonce;
    private $user;
    private $user1;
    

    protected $app;

    //this will be called first creer l'application pour faire les tests
	public function createApplication()
    {
        
        $dbName = 'timeshare-test';

		$app = require __DIR__.'/../../config-init.php';

		$app['debug'] = true;

		// Generate raw exceptions instead of HTML pages if errors occur
		$app['exception_handler']->disable();

        $this->user = new User('Zorro', 'mot de passe', 'Des Bois', 'Toto', '1450 Madison  Square', 'Singapour', 200, 'zorro@gmail.com');
        $this->user1 = new User('orroZ', 'mot de passe', 'Des Bois', 'Bob', '1450 Madison  Square', 'Singapour', 200, 'zorro@gmail.com');
        $this->annonce = new Annonce('Pelouse tondre',
                                     $this->user,
                                     \DateTime::createFromFormat('Y-m-d H:i:s', '2016-01-17 19:37:00'),
                                     \DateTime::createFromFormat('Y-m-d H:i:s', '2016-02-17 19:37:00'),
                                     'hennebont', 
                                     'jardinage',
                                     true);

        $this->app = $app;

		return $app;
    }
    
    	public function testGetAll()
	{
	    $client = $this->createClient();
	    $crawler = $client->request('GET', '/api/services/');

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
        $dm->persist($this->user1);       
        $dm->persist($this->annonce);
        $dm->flush();
        // create the advert
       
        $this->service = new Services(
                                      $this->user,
                                      $this->user1,
                                      $this->annonce,
                                      5,
                                      120
                );
                var_dump(json_encode($this->service));
        $resp = $client->request('POST', '/api/services/', array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode($this->service)
                
        );
        
        //verif create
        $this->assertEquals($client->getResponse()->getStatusCode(), 201);
        $data = json_decode($client->getResponse()->getContent());
        var_dump($data);
        //read + verif 
        $this->assertEquals($this->service->getNote(), $data->note);
        
        $currentId = $data->id;

        //update
        $this->service->setNote(3);
        $this->service->setTime(50);


         $resp = $client->request('PUT', '/api/services/'.$currentId, array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode($this->service)
        );

        

        $this->assertEquals($client->getResponse()->getStatusCode(), 200);

        $data = json_decode($client->getResponse()->getContent());

        //verif update
        $this->assertEquals(3, $data->note);

        //delete
        $client = $this->createClient();
        $crawler = $client->request('DELETE', '/api/services/'.$currentId);
        //verif delete
        $this->assertEquals($client->getResponse()->getStatusCode(), 200);
    }
    
}