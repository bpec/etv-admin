<?php

namespace Etv\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Etv\AdminBundle\Entity\AdminRole;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadRolesData implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager)
    {
        $roles = array(
            'ROLE_USER' => 'Administrator', 
            'ROLE_LEADER' => 'Moderator',
            'ROLE_ADMIN' => 'Super Admin');
        foreach ($roles as $roleName => $name) {
            $role = new AdminRole();
            $role->setName($name);
            $role->setRole($roleName);
            $manager->persist($role);
            $manager->flush();
        }
    }
}