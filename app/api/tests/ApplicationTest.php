<?php
namespace Timeshare\Tests;

use Silex\WebTestCase;
use Silex\Application;


class ApplicationTest extends WebTestCase
{
   public function createApplication()
   {
      $dbName = 'timeshare-test';

      $app = require __DIR__.'/../config-init.php';

      $app['debug'] = true;

      // Generate raw exceptions instead of HTML pages if errors occur
      $app['exception_handler']->disable();



      return $app;
   }


   public function testInitialPage()
   {
      $client  = $this->createClient();
      $crawler = $client->request('GET', '/');
      $this->assertTrue($client->getResponse()->isOk());
   }

   public function test404()
   {
      $client = $this->createClient();
      $client->request('GET', '/give-me-a-404');
      $this->assertEquals(404, $client->getResponse()->getStatusCode());
   }

}