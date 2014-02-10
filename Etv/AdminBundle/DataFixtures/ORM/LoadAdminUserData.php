<?php

namespace Etv\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Etv\AdminBundle\Entity\AdminUser;

class LoadAdminUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
            //'username' => array(firstname,lastname,dateofbirth, active, email, password, role),
            'admin' => array('Admin','Admin', '1977-11-11', 1, 'valami@valami.hu', 'admin', 'ROLE_ADMIN')
        );
        
        foreach ($users as $userName => $userData) {
            $user = new AdminUser();
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
            $role = $this->getReference($userData[6]);
            if ($role && $role instanceof \Etv\AdminBundle\Entity\AdminRole) {
                $user->addUserRole($role);
            }   
            $manager->persist($user);
            $manager->flush();
            if ($userData[6] == 'ROLE_ADMIN') {
                $this->addReference('super_admin', $user);
            }
        }
    }
    
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}