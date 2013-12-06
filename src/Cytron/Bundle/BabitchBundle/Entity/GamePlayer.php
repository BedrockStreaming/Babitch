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
 * @ORM\Table(name="game_player")
 * @Hateoas\Relation("player", href = @Hateoas\Route("get_player", parameters = { "id" = ".player.id"}))
 */
class GamePlayer extends AbstractEntity
{
    const POSITION_ATTACK  = 'attack';
    const POSITION_DEFENSE = 'defense';

    const TEAM_RED  = 'red';
    const TEAM_BLUE = 'blue';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     *
     * @var integer
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="gamePlayers")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     * @Assert\NotBlank()
     * @Serializer\Exclude()
     *
     * @var Game
     */
    protected $game;

    /**
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="gamePlayers")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     * @Assert\NotBlank()
     * @Serializer\Exclude()
     *
     * @var Player
     */
    protected $player;

    /**
     * @ORM\Column(name="team", type="string")
     * @Assert\NotBlank()
     * 
     * @var string
     */
    protected $team;

    /**
     * @ORM\Column(name="position", type="string")
     * @Assert\NotBlank()
     * 
     * @var string
     */
    protected $position;

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
     * @return array
     */
    public static function getAllowedTeams()
    {
        return array(
            self::TEAM_RED  => self::TEAM_RED,
            self::TEAM_BLUE => self::TEAM_BLUE,
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
     * @param string $team
     *
     * @return $this
     */
    public function setTeam($team)
    {
        if (!in_array($team, self::getAllowedTeams())) {
            throw new \Exception($team . " team is not allowed");
        }

        $this->team = $team;

        return $this;
    }

    /**
     * @return string
     */
    public function getTeam()
    {
        return $this->team;
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
}
