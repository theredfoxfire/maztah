<?php
// src/Entity/User.php
namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table("fos_user")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $superAdmin;
    /**
     * @ORM\Column(name="giroupy", type="string", nullable=true)
     */
    protected $group;

    protected $password;


    public function __construct()
    {
        parent::__construct();
        $this->superAdmin = false;
        $this->password = '';
        $this->groups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getSuperAdmin(): ?bool
    {
        return $this->superAdmin;
    }


    public function setSuperAdmin($superAdmin): self
    {
        $this->superAdmin = $superAdmin;

        return $this;
    }
}
