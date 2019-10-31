<?php

namespace App\Controller\backEnd;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GifController extends AbstractController
{
    /**
     * @Route("/gif", name="gif")
     */
    public function index()
    {
        return $this->render('gif/index.html.twig', [
            'controller_name' => 'GifController',
        ]);
    }
}
