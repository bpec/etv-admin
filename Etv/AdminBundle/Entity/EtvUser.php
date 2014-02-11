<?php

namespace Etv\AdminBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Etv\AdminBundle\Repository\EtvUserRepository")
 * @ORM\Table(name="etv_user")
 */
class EtvUser implements UserInterface, \Serializable
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
 * @ORM\Column(type="string", length=2, nullable=true)
 */
    protected $nationality;

/**
 * @ORM\Column(type="smallint", nullable=true)
 */
    protected $sex;

/**
 * @ORM\Column(type="boolean", nullable=true)
 */
    protected $is_ext_skipper;

 /**
 * @ORM\Column(type="boolean", nullable=true)
 */
    protected $is_hostess;
    
/**
 * @ORM\Column(type="boolean", nullable=true)
 */
    protected $is_intern;
/**
 * @ORM\Column(type="string", length=50, nullable=true)
 */
    protected $phone;

/**
 * @ORM\Column(type="string", length=50, nullable=true)
 */
    protected $address;

/**
 * @ORM\Column(type="string", length=50, nullable=true)
 */
    protected $city;

/**
 * @ORM\Column(type="string", length=50, nullable=true)
 */
    protected $zip;
/**
 * @ORM\Column(type="string", length=50, nullable=true)
 */
    protected $country;
/**
 * @ORM\Column(type="text", nullable=true)
 */
    protected $comments;
/**
 * @ORM\Column(type="text",nullable=true)
 */
    protected $flight_details;
/**
 * @ORM\Column(type="smallint", nullable=true)
 */
    protected $year;    
/**
 * @ORM\Column(type="bigint", nullable=true)
 */
    protected $fbUID;    

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

    /**
     * Set nationality
     *
     * @param string $nationality
     *
     * @return User
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return string 
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set sex
     *
     * @param integer $sex
     *
     * @return User
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return integer 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set is_ext_skipper
     *
     * @param boolean $isExtSkipper
     *
     * @return User
     */
    public function setIsExtSkipper($isExtSkipper)
    {
        $this->is_ext_skipper = $isExtSkipper;

        return $this;
    }

    /**
     * Get is_ext_skipper
     *
     * @return boolean 
     */
    public function getIsExtSkipper()
    {
        return $this->is_ext_skipper;
    }

    /**
     * Set is_hostess
     *
     * @param boolean $isHostess
     *
     * @return User
     */
    public function setIsHostess($isHostess)
    {
        $this->is_hostess = $isHostess;

        return $this;
    }

    /**
     * Get is_hostess
     *
     * @return boolean 
     */
    public function getIsHostess()
    {
        return $this->is_hostess;
    }

    /**
     * Set is_intern
     *
     * @param boolean $isIntern
     *
     * @return User
     */
    public function setIsIntern($isIntern)
    {
        $this->is_intern = $isIntern;

        return $this;
    }

    /**
     * Get is_intern
     *
     * @return boolean 
     */
    public function getIsIntern()
    {
        return $this->is_intern;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set zip
     *
     * @param string $zip
     *
     * @return User
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string 
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return User
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set flight_details
     *
     * @param string $flightDetails
     *
     * @return User
     */
    public function setFlightDetails($flightDetails)
    {
        $this->flight_details = $flightDetails;

        return $this;
    }

    /**
     * Get flight_details
     *
     * @return string 
     */
    public function getFlightDetails()
    {
        return $this->flight_details;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return User
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set fbUID
     *
     * @param integer $fbUID
     *
     * @return User
     */
    public function setFbUID($fbUID)
    {
        $this->fbUID = $fbUID;

        return $this;
    }

    /**
     * Get fbUID
     *
     * @return integer 
     */
    public function getFbUID()
    {
        return $this->fbUID;
    }
}
