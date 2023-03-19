<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/text", name="text", methods={"GET"})
     */
    public function getText(): Response
    {
        return $this->renderForm('text/new.html.twig');
    }
}
