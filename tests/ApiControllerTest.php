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

    public function GetQrCodeTestPost()
    {
        $client = static::createClient();

        $client->request('POST', '/');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }

    public function GetQrCodeTestPut()
    {
        $client = static::createClient();

        $client->request('PUT', '/');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }

    public function GetQrCodeTestDelete()
    {
        $client = static::createClient();

        $client->request('DELETE', '/');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }
}
//test file