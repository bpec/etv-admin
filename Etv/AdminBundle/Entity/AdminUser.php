<?php

namespace Etv\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Etv\AdminBundle\Repository\AdminUserRepository")
 * @ORM\Table(name="admin_user")
 */
class AdminUser implements UserInterface, \Serializable
{

/**
* @ORM\Column(name="id", type="integer")
* @ORM\Id
* @ORM\GeneratedValue(strategy="AUTO")
*/
 protected $id = null;

/**
 * @ORM\Column(type="string", length=32, unique=true, nullable=false)
 */
    protected $username;

/**
 * @ORM\Column(type="string", length=32, nullable=false)
 */
    protected $firstName;

/**
 * @ORM\Column(type="string", length=32, nullable=false)
 */
    protected $lastName;

/**
 * @ORM\Column(type="date", nullable=true)
 */
    protected $dateOfBirth;

/**
 * @ORM\Column(type="boolean", nullable=true)
 */    
    protected $active;

/**
 * @ORM\Column(type="string", length=128, unique=true, nullable=false)
 */
    protected $email;

/**
 * @ORM\Column(type="string", length=255, nullable=false)
 */
    protected $password;

/**
* @ORM\ManyToMany(targetEntity="AdminRole", inversedBy="users")
* @ORM\JoinTable(name="admin_user_role")
*/
    private $userRoles;

/**
 * @var string $salt
 *
 * @ORM\Column(type="string", length=40, nullable=true)
 */    
private $salt;

/**
 * @ORM\Column(type="string", length=255, nullable=true)
 */
    
protected $encoderName;
    
    public function __toString() {
        return $this->getFullname();
    }

    public function getFullname(){
        return $this->getFirstName().' '.$this->getLastName();
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     *
     * @return User
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime 
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get salt from password
     *
     * @return string 
     */
    public function getSalt()
    {
        $salt = substr($this->password, -32);
        return $salt;
    }
    
     /**
     * Get Roles
     *
     * @return string 
     */
    public function getRoles()
    {
        $roles = array();
        foreach ($this->userRoles->toArray() as $roleObj) {
            $roles[] = $roleObj->getRole();
        }
        return $this->userRoles->toArray();
    }

    /**
     * Set roles
     *
     * @param string $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->userRoles = $roles;

        return $this;
    }
    
    public function eraseCredentials()
    {
    }

    /**
     * Set encoderName
     *
     * @param string $encoderName
     *
     * @return AdminUser
     */
    public function setEncoderName($encoderName)
    {
        $this->encoderName = $encoderName;

        return $this;
    }

    /**
     * Get encoderName
     *
     * @return string 
     */
    public function getEncoderName()
    {
        return $this->encoderName;
    }
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userRoles =  new ArrayCollection();
    }

    /**
     * Add userRoles
     *
     * @param \Etv\AdminBundle\Entity\AdminRole $userRoles
     *
     * @return AdminUser
     */
    public function addUserRole(\Etv\AdminBundle\Entity\AdminRole $userRole)
    {
        $userRole->addUser($this);
        $this->userRoles[] = $userRole;

        return $this;
    }

    /**
     * Remove userRoles
     *
     * @param \Etv\AdminBundle\Entity\AdminRole $userRoles
     */
    public function removeUserRole(\Etv\AdminBundle\Entity\AdminRole $userRoles)
    {
        $this->userRoles->removeElement($userRoles);
    }

    /**
     * Get userRoles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserRoles()
    {
        return $this->userRoles;
    }

    /**
     * Serializes the content of the current User object
     * @return string
     */
    public function serialize()
    {
        return \json_encode(
                array($this->username, $this->password, $this->salt,
                       $this->userRoles, $this->id));
    }

    /**
     * Unserializes the given string in the current User object
     * @param serialized
     */
    public function unserialize($serialized)
    {
        list($this->username, $this->password, $this->salt,
                $this->userRoles, $this->id) = \json_decode(
                $serialized);
       
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return AdminUser
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }
}
