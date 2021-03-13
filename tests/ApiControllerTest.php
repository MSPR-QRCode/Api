<?php

// tests/ApiControllerTest.php
namespace App\Tests;

use App\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    /** @test */
    public function testroot()
    {
       $client = static::createClient();

        $client->request('get', '/');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }

    // /** @test */
    // public function testGetPromotionsWhenClientGet()
    // {
    //     $client = static::createClient();

    //     $client->request('get', '/api/promotions/');

    //     $this->assertEquals(405, $client->getResponse()->getStatusCode());
    // }

    // /** @test */
    // public function testGetPromotionsWhenClientPut()
    // {
    //     $client = static::createClient();

    //     $client->request('put', '/api/promotions/');

    //     $this->assertEquals(405, $client->getResponse()->getStatusCode());
    // }


    // /** @test */
    // public function testGetPromotionsWhenClientDelete()
    // {
    //     $client = static::createClient();

    //     $client->request('delete', '/api/promotions/');

    //     $this->assertEquals(405, $client->getResponse()->getStatusCode());
    // }


    // public function GetPromotionsWhenApiTokenIsNull()
    // {

    // }

    // public function GetPromotionsWhenApiTokenIsNotNull()
    // {
        
    // }

    // /** @test */
    // public function testGetQrCodeTestPost()
    // {
    //     $client = static::createClient();

    //     $client->request('post', '/api/qrcode?sample');

    //     $this->assertEquals(405, $client->getResponse()->getStatusCode());
    // }

    // /** @test */
    // public function testGetQrCodeTestPut()
    // {
    //     $client = static::createClient();

    //     $client->request('put', '/api/qrcode?sample');

    //     $this->assertEquals(405, $client->getResponse()->getStatusCode());
    // }

    
    // /** @test */
    // public function testGetQrCodeTestDelete()
    // {
    //     $client = static::createClient();

    //     $client->request('delete', '/api/qrcode?sample');

    //     $this->assertEquals(405, $client->getResponse()->getStatusCode());
    // }
 }