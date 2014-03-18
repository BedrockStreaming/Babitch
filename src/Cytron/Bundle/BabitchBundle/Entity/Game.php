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
 * @ORM\Table(name="game")
 * @Hateoas\Relation("self", href = @Hateoas\Route("get_game", parameters = { "id" = ".id"}))
 * @Hateoas\Relation("league",
 *   href =  @Hateoas\Route("get_league", parameters = { "id" = ".leagueId" }),
 *   excludeIf = { ".leagueId" = null }
 * )
 */
class Game extends AbstractEntity
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
     * @ORM\ManyToOne(targetEntity="League")
     * @ORM\JoinColumn(name="league_id", referencedColumnName="id")
     * @Serializer\Exclude()
     *
     * @var League
     */
    protected $league;

    /**
     * @ORM\Column(name="blue_score", type="integer")
     * @Assert\NotBlank()
     *
     * @var integer
     */
    protected $blueScore;

    /**
     * @ORM\Column(name="red_score", type="integer")
     * @Assert\NotBlank()
     *
     * @var integer
     */
    protected $redScore;

    /**
     * @var GamePlayer[]
     *
     * @ORM\OneToMany(targetEntity="GamePlayer", mappedBy="game", cascade={"persist", "remove"})
     * @Assert\Valid()
     * @Serializer\SerializedName("composition")
     */
    protected $gamePlayers;

    /**
     * @var Goal[]
     *
     * @ORM\OneToMany(targetEntity="Goal", mappedBy="game", cascade={"persist", "remove"})
     * @Assert\Valid()
     * @Serializer\SerializedName("goals")
     */
    protected $goals;

    /**
     * @ORM\Column(name="started_at", type="datetime", nullable=true)
     * @Serializer\Type("DateTime<'Y-m-d H:i:s'>")
     */
    protected $startedAt;

    /**
     * @ORM\Column(name="ended_at", type="datetime", nullable=true)
     * @Serializer\Type("DateTime<'Y-m-d H:i:s'>")
     */
    protected $endedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->gamePlayers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->goals       = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param League $league
     *
     * @return $this
     */
    public function setLeague($league)
    {
        $this->league = $league;

        return $this;
    }

    /**
     * @return League
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * @Serializer\VirtualProperty()
     * @Serializer\SerializedName("league_id")
     * @Serializer\Type("integer")
     *
     * @return integer
     */
    public function getLeagueId()
    {
        if (!$this->getLeague()) {
          return null;
        }

        return $this->getLeague()->getId();
    }

    /**
     * @param integer $blueScore
     *
     * @return $this
     */
    public function setBlueScore($blueScore)
    {
        $this->blueScore = $blueScore;

        return $this;
    }

    /**
     * @return integer
     */
    public function getBlueScore()
    {
        return $this->blueScore;
    }

    /**
     * @param integer $redScore
     *
     * @return $this
     */
    public function setRedScore($redScore)
    {
        $this->redScore = $redScore;

        return $this;
    }

    /**
     * @return integer
     */
    public function getRedScore()
    {
        return $this->redScore;
    }

    /**
     * @param \Cytron\Bundle\BabitchBundle\Entity\GamePlayer[] $gamePlayers
     *
     * @return $this
     */
    public function setGamePlayers($gamePlayers)
    {
        foreach ($gamePlayers as $gamePlayer) {
            $gamePlayer->setGame($this);
        }
        $this->gamePlayers = $gamePlayers;

        return $this;
    }

    /**
     * @return \Cytron\Bundle\BabitchBundle\Entity\GamePlayer[]
     */
    public function getGamePlayers()
    {
        return $this->gamePlayers;
    }

    /**
     * GamePlayer Adder
     *
     * @param GamePlayer $gamePlayer
     *
     * @return $this
     */
    public function addGamePlayer(GamePlayer $gamePlayer)
    {
        $gamePlayer->setGame($this);
        $this->gamePlayers->add($gamePlayer);

        return $this;
    }

    /**
     * GamePlayer Remover
     *
     * @param GamePlayer $gamePlayer
     *
     * @return $this
     */
    public function removeGamePlayer(GamePlayer $gamePlayer)
    {
        $this->gamePlayers->removeElement($gamePlayer);

        return $this;
    }

    /**
     * @param \Cytron\Bundle\BabitchBundle\Entity\Goal[] $goals
     *
     * @return $this
     */
    public function setGoals($goals)
    {
        foreach ($goals as $goal) {
            $goal->setGame($this);
        }
        $this->goals = $goals;

        return $this;
    }

    /**
     * @return \Cytron\Bundle\BabitchBundle\Entity\Goal[]
     */
    public function getGoals()
    {
        return $this->goals;
    }

    /**
     * Goal Adder
     *
     * @param Goal $goal
     *
     * @return $this
     */
    public function addGoal(Goal $goal)
    {
        $goal->setGame($this);
        $this->goals->add($goal);

        return $this;
    }

    /**
     * Goal Remover
     *
     * @param Goal $goal
     *
     * @return $this
     */
    public function removeGoal(Goal $goal)
    {
        $this->goals->removeElement($goal);

        return $this;
    }

    /**
     * Set start date
     *
     * @param \DateTime $date Start date
     *
     * @return $this
     */
    public function setStartedAt(\DateTime $date = null)
    {
        $this->startedAt = $date;

        return $this;
    }

    /**
     * Get start date
     *
     * @return \DateTime
     */
    public function getStartedAt()
    {
        return $this->startedAt;
    }

    /**
     * Set end date
     *
     * @param \DateTime $date End date
     *
     * @return $this
     */
    public function setEndedAt(\DateTime $date = null)
    {
        $this->endedAt = $date;

        return $this;
    }

    /**
     * Get end date
     *
     * @return \DateTime
     */
    public function getEndedAt()
    {
        return $this->endedAt;
    }
}
