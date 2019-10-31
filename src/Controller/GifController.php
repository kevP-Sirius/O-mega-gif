<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Hashids\Hashids;
use App\Entity\Gif;

class GifController extends AbstractController
{
    /**
     * @Route("/user/gif-management/{username}", name="gif_content")
     */
    public function index(string $username)
    {   
        return $this->render('logged-user/gif-management.html.twig', [
            'username'=>$username
        ]);
    }

     /**
     * @Route("/user/drop-gif", name="gif_drop", methods={ "POST" })
     */
    public function dropGifUser(Request $request)
    {
        $gif = new Gif ;
        $uploadDir="/home/mint/Bureau/html/projet-perso/omega-gif/src/Controller/uploadedFiles";
        $file= $_FILES['file']['tmp_name'];
        $name =$_FILES['file']['name'];
        $gif->setName($name);
        $gif->setPath("$uploadDir/".$unique.$name);
        $em = $this->getDoctrine()->getManager();
        $em->persist($gif);
        $em->flush();
        // DD($_FILES['file']['error']);
        // DD(exec('whoami'));
        $unique = uniqid($prefix='',$more_entropy=true);
        // DD($unique);
        move_uploaded_file($file,"$uploadDir/".$unique.$name);
        $response = new Response();
        $downloadGifStatus ='added';
        $response->setContent(json_encode(

            [  
                
                'gif_status'=> $downloadGifStatus,
                
                
            ]));
        $response->headers->set('Content-Type', 'application/json');
                
        return $response ;
    }
}
