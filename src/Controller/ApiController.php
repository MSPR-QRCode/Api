<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\QrCode;
use App\Entity\ApiKey;
use Doctrine\ORM\Tools\Pagination\Paginator;

class ApiController extends AbstractController
{
    /**
     * @Route("/", name="root")
     */
    public function root(Request $request) : Response
    {

        $error_405 = array("Error" => "Methods not allowed (405)" , "errorMessage" => "No methods are allowed with this URL");

        $json = json_encode($error_405);
        $response = new Response($json, 405,
            ["Content-Type" => "application/json"

            ]);
        return $response;
    }

    /**
     * @Route("/api/qrcode", name="api_qrcode_error")
     * @Route("/api/qrcode?{idQrCode}", name="api_scan_qrcode")
     */
    public function GetQrCode(Request $request, SerializerInterface $serializer) : Response
    {

        if ($request->isMethod('post')) {
            $error_405 = array("Error" => "Bad Request (405)" , "errorMessage" => "Method POST is not allowed for api/qrcode?idQrCode={code}");

            $json = json_encode($error_405);
            $response = new Response($json, 405,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

        else if ($request->isMethod('put')) {
            $error_405 = array("Error" => "Bad Request (405)" , "errorMessage" => "Method PUT is not allowed for api/qrcode?idQrCode={code}");

            $json = json_encode($error_405);
            $response = new Response($json, 405,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

        else if ($request->isMethod('delete')) {
            $error_405 = array("Error" => "Bad Request (405)" , "errorMessage" => "Method DELETE is not allowed for api/qrcode?idQrCode={code}");

            $json = json_encode($error_405);
            $response = new Response($json, 405,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

        $apiToken = $request->headers->get('MSPR-ApiKey');

        if($apiToken == null)
        {
            $error_401 = array("Error" => "Unauthorized (401)" , "errorMessage" => "You need an API Key to access to this resource. Please refer to documentation for more details.");

            $json = json_encode($error_401);
            $response = new Response($json, 401,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

        else
        {
            $token = $this->getDoctrine()->getRepository(ApiKey::class)->findBy(['token' => $apiToken]);

            if($token == null)
            {
                $error_401 = array("Error" => "Unauthorized (401)" , "errorMessage" => "Invalid API Key. Please refer to documentation for more details.");

                $json = json_encode($error_401);
                $response = new Response($json, 401,
                    ["Content-Type" => "application/json"

                    ]);
                return $response;
            }
        }

        $idQrCode = $request->query->get('idQrCode');

        if($idQrCode == null)
        {

            $error_400 = array("Error" => "Bad Request (400)" , "errorMessage" => "The query parameter 'idQrCode' is required");

            $json = json_encode($error_400);
            $response = new Response($json, 400,
                ["Content-Type" => "application/json"

                ]);
            return $response;

        }

        else
        {

            try
            {
                $qrcode = $this->getDoctrine()->getRepository(QrCode::class)->findBy(['idQRCode' => $idQrCode]);

                $jsonContent = $serializer->serialize($qrcode[0], 'json', ['groups' => 'jsonGetIdAndMy']);

                $response = new Response($jsonContent, 200,
                    ["Content-Type" => "application/json"

                    ]);

                return $response;

            }

            catch (\Exception $exception)
            {
                $error_404 = array("Error" => "QRCode wasn't found (404)", "errorMessage" => "No qrcode was found for this id");
                $json = json_encode($error_404);
                $response = new Response($json, 404,
                    ["Content-Type" => "application/json"

                    ]);
                return $response;
            }
        }

    }

    /**
     * @Route("/api/my-qrcodes", name="api_myqrcodes")
     */
    public function GetMyQrCodes(Request $request, SerializerInterface $serializer) : Response
    {

        if ($request->isMethod('get')) {
            $error_405 = array("Error" => "Bad Request (405)" , "errorMessage" => "Method GET is not allowed for api/my-qrcodes");

            $json = json_encode($error_405);
            $response = new Response($json, 405,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

        else if ($request->isMethod('put')) {
            $error_405 = array("Error" => "Bad Request (405)" , "errorMessage" => "Method PUT is not allowed for api/my-qrcodes");

            $json = json_encode($error_405);
            $response = new Response($json, 405,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

        else if ($request->isMethod('delete')) {
            $error_405 = array("Error" => "Bad Request (405)" , "errorMessage" => "Method DELETE is not allowed for api/my-qrcodes");

            $json = json_encode($error_405);
            $response = new Response($json, 405,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

        $apiToken = $request->headers->get('MSPR-ApiKey');

        if($apiToken == null)
        {
            $error_401 = array("Error" => "Unauthorized (401)" , "errorMessage" => "You need an API Key to access to this resource. Please refer to documentation for more details.");

            $json = json_encode($error_401);
            $response = new Response($json, 401,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

        else
        {
            $token = $this->getDoctrine()->getRepository(ApiKey::class)->findBy(['token' => $apiToken]);

            if($token == null)
            {
                $error_401 = array("Error" => "Unauthorized (401)" , "errorMessage" => "Invalid API Key. Please refer to documentation for more details.");

                $json = json_encode($error_401);
                $response = new Response($json, 401,
                    ["Content-Type" => "application/json"

                    ]);
                return $response;
            }
        }

        try
        {
            $requestBody = $request->toArray();
        }

        catch (\Exception $exception)
        {
            $error_400 = array("Error" => "Bad Request (400)" , "errorMessage" => "The array MyIdQRCodes is missing in the body of the request");

            $json = json_encode($error_400);
            $response = new Response($json, 400,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

        try
        {
            $myIdQrCode = $requestBody['MyIdQRCodes'];
        }

        catch (\Exception $exception)
        {
            $error_400 = array("Error" => "Bad Request (400)" , "errorMessage" => "The array MyIdQRCodes is missing or invalid in the body of the request");

            $json = json_encode($error_400);
            $response = new Response($json, 400,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

        $nbId = sizeof($myIdQrCode);
        $allQrCode = array();
        $errorQrCode = array();

        for ($i = 0;$i < $nbId;$i++)
        {

            $qrcode = $this->getDoctrine()->getRepository(QrCode::class)->findBy(['idQRCode' => $myIdQrCode[$i]]);

            if($qrcode != null)
            {
                array_push($allQrCode, $qrcode[0]);
            }

            else
            {
                array_push($errorQrCode, $myIdQrCode[$i]);
            }

        }

        $array_response = array("MyQrCodes" => $allQrCode, "Unknown_idQrCode" => $errorQrCode);
        $json = $serializer->serialize($array_response, 'json', ['groups' => 'jsonGetIdAndMy']);
        $response = new Response($json, 200,
            ["Content-Type" => "application/json"

            ]);
        return $response;

    }

    /**
     * @Route("/api/promotions", name="api_promotions_qrcode")
     */
    public function GetPromotions(Request $request, SerializerInterface $serializer) : Response
    {

        if ($request->isMethod('get')) {
            $error_405 = array("Error" => "Bad Request (405)" , "errorMessage" => "Method GET is not allowed for api/promotions");

            $json = json_encode($error_405);
            $response = new Response($json, 405,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

        else if ($request->isMethod('put')) {
            $error_405 = array("Error" => "Bad Request (405)" , "errorMessage" => "Method PUT is not allowed for api/promotions");

            $json = json_encode($error_405);
            $response = new Response($json, 405,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

        else if ($request->isMethod('delete')) {
            $error_405 = array("Error" => "Bad Request (405)" , "errorMessage" => "Method DELETE is not allowed for api/promotions");

            $json = json_encode($error_405);
            $response = new Response($json, 405,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

        /*
        // Body de la requête
            {
            "nbOfQrCode": 10,
            "firstId" : 5,
            }
        */

        $apiToken = $request->headers->get('MSPR-ApiKey');

        if($apiToken == null)
        {
            $error_401 = array("Error" => "Unauthorized (401)" , "errorMessage" => "You need an API Key to access to this resource. Please refer to documentation for more details.");

            $json = json_encode($error_401);
            $response = new Response($json, 401,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

        else
        {
            $token = $this->getDoctrine()->getRepository(ApiKey::class)->findBy(['token' => $apiToken]);

            if($token == null)
            {
                $error_401 = array("Error" => "Unauthorized (401)" , "errorMessage" => "Invalid API Key. Please refer to documentation for more details.");

                $json = json_encode($error_401);
                $response = new Response($json, 401,
                    ["Content-Type" => "application/json"

                    ]);
                return $response;
            }
        }

        try
        {
            $requestBody = $request->toArray();
        }

        catch (\Exception $exception)
        {
            $error_400 = array("Error" => "Bad Request (400)" , "errorMessage" => "The parameters nbOfQrCode and/or firstId are missing in the body of the request");

            $json = json_encode($error_400);
            $response = new Response($json, 400,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

        try
        {
            $numberOfQrCode = $requestBody['numberOfQrCode'];
        }

        catch (\Exception $exception)
        {
            $error_400 = array("Error" => "Bad Request (400)" , "errorMessage" => "The parameter numberOfQrCode is missing in the body of the request");

            $json = json_encode($error_400);
            $response = new Response($json, 400,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

        try
        {
            $firstId = $requestBody['firstId'];
        }

        catch (\Exception $exception)
        {
            $error_400 = array("Error" => "Bad Request (400)" , "errorMessage" => "The parameter firstId is missing in the body of the request");

            $json = json_encode($error_400);
            $response = new Response($json, 400,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }
        $date = new \DateTime('now');
        $timestamp = $date->getTimestamp();
        try {
            $myIdQrCode = $requestBody['MyIdQRCodes'];
            try {
                $name = $requestBody['searchName'];
                $query = "SELECT id,id_qrcode AS idQRCode,name,description,image,date_crea AS dateCrea,date_exp AS dateExp,code_promo AS codePromo FROM qr_code WHERE date_exp > $timestamp AND name LIKE '$name%' LIMIT $firstId , $numberOfQrCode";
                $queryNbOfQrCode = "SELECT COUNT(*) FROM qr_code WHERE date_exp > $timestamp AND name LIKE '$name%'";
            }

            catch (\Exception $exception)
            {
                $query = "SELECT id,id_qrcode AS idQRCode,name,description,image,date_crea AS dateCrea,date_exp AS dateExp,code_promo AS codePromo FROM qr_code WHERE date_exp > $timestamp LIMIT $firstId , $numberOfQrCode";
                $queryNbOfQrCode = "SELECT COUNT(*) FROM qr_code WHERE date_exp > $timestamp";
            }

            $connection = $this->getDoctrine()->getManager()->getConnection()->prepare($query);
            $connection->execute();
            $allPromotions = $connection->fetchAll();
            $sizeAllPromos = sizeof($allPromotions);


            $connection = $this->getDoctrine()->getManager()->getConnection()->prepare($queryNbOfQrCode);
            $connection->execute();
            $nbOfQrCode = $connection->fetchAll();

            for($i=0;$i<$sizeAllPromos;$i++)
            {
                if(!in_array($allPromotions[$i]["idQRCode"],$myIdQrCode))
                {
                    unset($allPromotions[$i]["idQRCode"]);
                    unset($allPromotions[$i]["codePromo"]);
                }
            }

            $array_response = array("promotions" => $allPromotions, "NbOfQrCode" => $nbOfQrCode[0]["COUNT(*)"]);
            $jsonContent = $serializer->serialize($array_response, 'json', ['groups' => 'jsonPromotions']);

            $response = new Response($jsonContent, 200,
                ["Content-Type" => "application/json"

                ]);

            return $response;
        }

        catch (\Exception $exception)
        {
            try {
                $name = $requestBody['searchName'];
                $query = "SELECT id,name,description,image,date_crea AS dateCrea,date_exp AS dateExp FROM qr_code WHERE date_exp > $timestamp AND name LIKE '$name%' LIMIT $firstId , $numberOfQrCode";
                $queryNbOfQrCode = "SELECT COUNT(*) FROM qr_code WHERE date_exp > $timestamp AND name LIKE '$name%'";
            }

            catch (\Exception $exception)
            {
                $query = "SELECT id,name,description,image,date_crea AS dateCrea,date_exp AS dateExp FROM qr_code WHERE date_exp > $timestamp LIMIT $firstId , $numberOfQrCode";
                $queryNbOfQrCode = "SELECT COUNT(*) FROM qr_code WHERE date_exp > $timestamp";
            }

            $connection = $this->getDoctrine()->getManager()->getConnection()->prepare($query);
            $connection->execute();
            $allPromotions = $connection->fetchAll();

            $connection = $this->getDoctrine()->getManager()->getConnection()->prepare($queryNbOfQrCode);
            $connection->execute();
            $nbOfQrCode = $connection->fetchAll();

            $array_response = array("promotions" => $allPromotions, "NbOfQrCode" => $nbOfQrCode[0]["COUNT(*)"]);
            $jsonContent = $serializer->serialize($array_response, 'json', ['groups' => 'jsonPromotions']);

            $response = new Response($jsonContent, 200,
                ["Content-Type" => "application/json"

                ]);

            return $response;

        }

        catch (\Exception $exception)
        {
            $error_400 = array("Error" => "Bad Request (400)" , "errorMessage" => "The parameters numberOfQrCode and/or firstId are invalid in the body of the request");

            $json = json_encode($error_400);
            $response = new Response($json, 400,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

    }


    /**
     * @Route("/api/create-qrcode/{test}", name="api_create_qrcode")
     */
    public function CreateQrCode($test, Request $request)
    {

        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $randomString = "MSPR_" . $randomString;
            return $randomString;
        }

        $apiToken = $request->headers->get('MSPR-ApiKey');

        if($apiToken == null)
        {
            $error_401 = array("Error" => "Unauthorized (401)" , "errorMessage" => "You need an API Key to access to this resource. Please refer to documentation for more details.");

            $json = json_encode($error_401);
            $response = new Response($json, 401,
                ["Content-Type" => "application/json"

                ]);
            return $response;
        }

        else
        {
            $token = $this->getDoctrine()->getRepository(ApiKey::class)->findBy(['token' => $apiToken]);

            if($token == null)
            {
                $error_401 = array("Error" => "Unauthorized (401)" , "errorMessage" => "Invalid API Key. Please refer to documentation for more details.");

                $json = json_encode($error_401);
                $response = new Response($json, 401,
                    ["Content-Type" => "application/json"

                    ]);
                return $response;
            }
        }

        $qrcode = new QrCode();
        $qrcode->setName("Test " . strval($test));
        $qrcode->setDescription("Nullam sed luctus lectus. Nulla finibus dictum bibendum. Donec ultrices vel dolor eget dictum. Praesent aliquet sapien luctus orci feugiat, id malesuada lorem dignissim. Quisque gravida, turpis a dignissim viverra, eros odio mattis enim, a euismod turpis.");
        date_default_timezone_set('UTC');

        $qrcode->setIdQRCode(generateRandomString());
        $qrcode->setImage("https://api-mspr.thejulienm.fr/image/skate.jpg");
        $date = new \DateTime('now');
        $timestamp =  $date->getTimestamp();
        $qrcode->setDateCrea($timestamp);
        $date_30 = $date->add(new \DateInterval("P30D"));
        $timestamp_30 = $date_30->getTimestamp();

        $qrcode->setDateExp($timestamp_30);
        $qrcode->setCodePromo("CODEPROMO" . strval($test));

        //$manager = $this->getDoctrine()->getManager();
        //$manager->persist($qrcode);
        //$manager->flush();

    }


}
