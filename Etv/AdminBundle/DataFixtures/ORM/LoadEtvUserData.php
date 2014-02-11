<?php

namespace Etv\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Etv\AdminBundle\Entity\EtvUser;

class LoadEtvUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;
    
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager)
    {
        $users = array(
            //'username' => array(firstname,lastname,dateofbirth, active, email, password),
            'johnsmith' => array('john','smith', '1987-12-11', 1, 'johnsmith@gmail.hu', 'smith', 'GB')
        );
        
        foreach ($users as $userName => $userData) {
            $user = new EtvUser();
            $user->setUsername($userName);
            $user->setFirstName($userData[0]);
            $user->setLastName($userData[1]);
            $dob = new \DateTime($userData[2]);
            $dob->format('Y-m-d');
            $user->setDateOfBirth($dob);
            $user->setActive($userData[3]);
            $user->setEmail($userData[4]);
            
            $salt = md5(rand());
            $encoderService = $this->container->get('security.encoder_factory')->getEncoder($user);
            $password = $encoderService->encodePassword($userData[5], $salt);
            $user->setPassword($password);
            
            $user->setCountry($userData[6]);
            
            $manager->persist($user);
            $manager->flush();
           
        }
    }
    
    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}