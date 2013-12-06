<?php

namespace Cytron\Bundle\BabitchBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use FSC\HateoasBundle\Annotation as Hateoas;
use JMS\Serializer\Annotation as Serializer;

/**
 * Babitch Game Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="goal")
 */
class Goal extends AbstractEntity
{
    const POSITION_ATTACK  = 'attack';
    const POSITION_DEFENSE = 'defense';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     *
     * @var integer
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="goals")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     * @Assert\NotBlank()
     * @Serializer\Exclude()
     *
     * @var Game
     */
    protected $game;

    /**
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="goals")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     * @Assert\NotBlank()
     * @Serializer\Exclude()
     *
     * @var Player
     */
    protected $player;

    /**
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="conceder_id", referencedColumnName="id")
     * @Assert\NotBlank()
     * @Serializer\Exclude()
     *
     * @var Player
     */
    protected $conceder;

    /**
     * @ORM\Column(name="position", type="string")
     * @Assert\NotBlank()
     * 
     * @var string
     */
    protected $position;

    /**
     * @ORM\Column(name="autogoal", type="boolean")
     * @Assert\NotNull()
     *
     * @var boolean
     */
    protected $autogoal;

    /**
     * @return array
     */
    public static function getAllowedPositions()
    {
        return array(
            self::POSITION_ATTACK  => self::POSITION_ATTACK,
            self::POSITION_DEFENSE => self::POSITION_DEFENSE,
        );
    }

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
     * @param Game $game
     *
     * @return $this
     */
    public function setGame(Game $game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * @return Game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param Player $player
     *
     * @return $this
     */
    public function setPlayer($player)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("player_id")
     * @Serializer\Type("integer")
     *
     * @return integer
     */
    public function getPlayerId()
    {
        return $this->getPlayer()->getId();
    }

    /**
     * @param Player $conceder
     *
     * @return $this
     */
    public function setConceder($conceder)
    {
        $this->conceder = $conceder;

        return $this;
    }

    /**
     * @return Player
     */
    public function getConceder()
    {
        return $this->conceder;
    }

    /**
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("conceder_id")
     * @Serializer\Type("integer")
     *
     * @return integer
     */
    public function getConcederId()
    {
        return $this->getConceder()->getId();
    }

    /**
     * @param string $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        if (!in_array($position, self::getAllowedPositions())) {
            throw new \Exception($position . " position is not allowed");
        }

        $this->position = $position;

        return $this;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param boolean $autogoal
     *
     * @return $this
     */
    public function setAutogoal($autogoal)
    {
        $this->autogoal = $autogoal;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAutogoal()
    {
        return $this->autogoal;
    }
}
