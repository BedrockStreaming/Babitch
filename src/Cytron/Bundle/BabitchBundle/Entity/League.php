<?php

namespace Cytron\Bundle\BabitchBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use FSC\HateoasBundle\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

/**
 * Babitch League Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="league")
 * @Hateoas\Relation("self", href = @Hateoas\Route("get_player", parameters = { "id" = ".id"}))
 */
class League extends AbstractEntity
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
     * @ORM\OneToMany(targetEntity="Game", mappedBy="league")
     * @Serializer\Exclude()
     *
     * @var ArrayCollection
     */
    protected $games;

    /**
     * @ORM\Column(name="name", type="string")
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $name;

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
}
