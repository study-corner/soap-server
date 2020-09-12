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
        $dir =  realpath(__DIR__ . '/../../public/schema') ;
        $soapServer = new \SoapServer($dir . '/hello.xml');
        $soapServer->setObject($helloService);

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');

        ob_start();
        $soapServer->handle();
        $content = ob_get_clean();
        $response->setContent($content);

        return $response;
    }
}
