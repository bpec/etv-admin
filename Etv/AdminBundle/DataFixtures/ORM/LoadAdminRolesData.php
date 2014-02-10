<?php

namespace Etv\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Etv\AdminBundle\Entity\AdminRole;

class LoadAdminRolesData extends AbstractFixture implements OrderedFixtureInterface
{
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
            $this->addReference($roleName, $role);
        }
    }
    
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}