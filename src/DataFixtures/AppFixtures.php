<?php

namespace App\DataFixtures;
use App\Entity\User;
use Faker\Factory;
use Nelmio\Alice\Loader\NativeLoader;
use App\DataFixtures\MyCustomNativeLoader;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder,UserRepository $UR ,RoleRepository $RR)
    {
        
      $this->encoder = $encoder;   
      $this->UR = $UR;
      $this->RR = $RR;

    }

    public function load(ObjectManager $em)
    {
        $loader = new MyCustomNativeLoader();
        
        //importe le fichier de fixtures et récupère les entités générés
        $entities = $loader->loadFile(__DIR__.'/fixtures.yml')->getObjects();
        
        //empile la liste d'objet à enregistrer en BDD
        foreach ($entities as $entity) {
            $em->persist($entity);
        };
        
        //enregistre
        $em->flush();


        $users = $this->UR->findall();
        $roles = $this->RR->findall();
        $faker =  Factory::create('fr_FR'); 


        
        foreach ($users as $user ) {
         
           

            $encodedPassword = $this->encoder->encodePassword($user, $user->getPassword()); 
            $user->setUsername($faker->unique()->username);
            $user->setPassword($encodedPassword);
            $em->persist($user);
            $em->flush();

        }


        foreach($roles as $role){
            if($role->getName() == 'user'){
                $role->setRoleString('ROLE_USER');
            }
            if($role->getName() == 'administrator'){
                $role->setRoleString('ROLE_ADMIN');
            }
            $em->persist($role);
            $em->flush();
        }

        $roleString = 'ROLE_ADMIN' ;
        $adminRole = $this->RR->findByRoleString($roleString);
        $userAdmin =new User ;
        $userAdmin->setUsername('admin');
        $userAdmin->setRole($adminRole[0]);
        $userAdmin->setEmail('kev972@gmail.com');
        $encodedPassword = $this->encoder->encodePassword($userAdmin, 'Prime$972!'); 
        $userAdmin->setPassword($encodedPassword);
        $em->persist($userAdmin);
        $em->flush();
    }


    
}  