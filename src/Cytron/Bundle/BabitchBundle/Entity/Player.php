<?php

namespace Cytron\Bundle\BabitchBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use FSC\HateoasBundle\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

/**
 * Babitch Player Entity
 *
 * @ORM\Entity(repositoryClass="Cytron\Bundle\BabitchBundle\Repository\PlayerRepository")
 * @ORM\Table(name="player")
 * @Hateoas\Relation("self", href = @Hateoas\Route("get_player", parameters = { "id" = ".id"}))
 */
class Player extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     *
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(name="email", type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $email;

    /**
     * @var GamePlayer[]
     *
     * @ORM\OneToMany(targetEntity="GamePlayer", mappedBy="player")
     * @Serializer\Exclude()
     */
    protected $gamePlayers;

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
