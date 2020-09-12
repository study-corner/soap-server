<?php

namespace App\Controller;

use App\Service\HelloService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * @Route("/soap")
     * @param HelloService $helloService
     * @return Response
     */
    public function index(HelloService $helloService)
    {
        $soapServer = new \SoapServer('/path/to/hello.wsdl');
        $soapServer->setObject($helloService);

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');

        ob_start();
        $soapServer->handle();
        $response->setContent(ob_get_clean());

        return $response;
    }
}
