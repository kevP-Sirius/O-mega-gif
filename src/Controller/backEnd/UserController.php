<?php

namespace App\Controller\backEnd;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/home/{username}", name="admin_home")
     */
    public function index(string $username)
    {
        return $this->render('back-end/index.html.twig', [
            'username' => $username,
        ]);
    }
}
