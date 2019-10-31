<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GifRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(GifRepository $gifs)
    {
        $allGifs = $gifs->findAll();
        return $this->render('home/index.html.twig', [
            'gifs' =>$allGifs,
        ]);
    }

     /**
     * @Route("/signin", name="signin")
     */
    public function signin()
    {   
        
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
