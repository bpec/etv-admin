<?php

namespace Etv\AdminBundle\Entity;
use \Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Etv\AdminBundle\Entity\AdminRole
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Etv\AdminBundle\Repository\AdminRoleRepository")
 */
class AdminRole implements RoleInterface, \Serializable
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
     /**
     * @ORM\Column(name="role", type="string", length=20, unique=true)
     */
    private $role;
    
    /**
     * @ORM\ManyToMany(targetEntity="AdminUser", mappedBy="userRoles")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * Methods for RoleInterface
     */

    public function getRole()
    {
       return $this->role;
    }
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Add users
     *
     * @param Etv\AdminBundle\Entity\AdminUser $users
     */
    public function addUser($users)
    {
        $this->users[] = $users;
    }

    /**
     * Get users
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Remove users
     *
     * @param \Etv\AdminBundle\Entity\AdminUser $users
     */
    public function removeUser(\Etv\AdminBundle\Entity\AdminUser $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return AdminRole
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
    
        // .....    

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        /*
         * ! Don't serialize $users field !
         */
        return \json_encode(array(
            $this->id,
            $this->role
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->role
        ) = \json_decode($serialized);
    }
}
