<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InfoController extends AbstractController
{
    /**
     * @Route("/info", name="info")
     */
    public function index()
    {
        phpinfo();

        return $this->json('');
    }
}
