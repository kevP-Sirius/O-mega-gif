<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\LoginType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Repository\RoleRepository;
use Symfony\Component\Mailer\Mailer;

class UserController extends AbstractController
{
    /**
     * @Route("/user/home/{username}", name="user_home")
     */
    public function index(string $username)
    {   
        // DD('USERHOME');
        return $this->render('logged-user/index.html.twig', [
            'username' => $username,
        ]);
    }

    /**
     * @Route("/signup", name="app_signup")
     */
    public function signup(Request $request, UserPasswordEncoderInterface $passwordEncoder,\Swift_Mailer $mailer,RoleRepository $roles,UserRepository $users)
    {
        $user = new User();
    
        $form = $this->createForm(LoginType::class, $user);
        $form->handleRequest($request);
        $roleString = 'ROLE_USER' ;
        $userRole = $roles->findByRoleString($roleString);
        if($form->isSubmitted() && $form->isValid()) {
            $searchUsername = $users->findByNameUser($form->get('username')->getData());
            $searchEmail =  $users->findByMail($form->get('email')->getData());
            if($searchUsername!=[] || $searchEmail!=[]){
                $this->addFlash(
                    'warning',
                    'Ce nom d\'utilisateur ou cet email sont déja utilisé'
                );
            }else{
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );
                $user->setRole($userRole[0]);
    
                $subscribe = (new \Swift_Message('Omega-gif subscribe'))
                ->setFrom('O\'mega-gif@project.com')
                ->setTo($form->get('email')->getData())
                ->setBody(
                    $this->renderView(
                        // templates/emails/registration.html.twig
                        'back-end/email/subscribe.html.twig',
                        [   
                           
                            'username'=> $form->get('username')->getData()
                      
    
                        ]
                    ),
                    'text/html'
                );
                $result = $mailer->send($subscribe);
    
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
    
                $this->addFlash(
                    'success',
                    'Enregistrement effectué'
                );
                return $this->redirectToRoute('app_login');
            }
          

            
        }

        return $this->render('home/subscribe.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
        
       
    }

     /**
     * @Route("/user/my-account/", name="my_account")
     */
    public function myAccount()
    {   
        // DD('USERHOME');
        return $this->render('logged-user/my-account.html.twig', [
           
        ]);
    }
}
