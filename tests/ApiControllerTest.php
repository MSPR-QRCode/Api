<?php

// tests/ApiControllerTest.php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function rootTest()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }
}