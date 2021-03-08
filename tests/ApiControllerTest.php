<?php

// tests/ApiControllerTest.php
namespace App\Tests;

use App\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    // public function rootTest()
    // {
    //     $client = static::createClient();

    //     $client->request('get', '/');

    //     $this->assertEquals(405, $client->getResponse()->getStatusCode());
    // }

    public function GetPromotionsWhenClientGet()
    {
        $client = static::createClient();

        $client->request('GET', '/api/promotions/');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }

    public function GetPromotionsWhenClientPut()
    {
        $client = static::createClient();

        $client->request('put', '/api/promotions/');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }

    public function GetPromotionsWhenClientDelete()
    {
        $client = static::createClient();

        $client->request('delete', '/api/promotions/');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }

    public function GetPromotionsWhenApiTokenIsNull()
    {

    }

    public function GetPromotionsWhenApiTokenIsNotNull()
    {

    }
}