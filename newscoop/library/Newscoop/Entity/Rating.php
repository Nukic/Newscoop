<?php
/**
 * @package Newscoop
 * @copyright 2012 Sourcefabric o.p.s.
 * @license http://www.gnu.org/licenses/gpl.txt
 */

namespace Newscoop\Entity;

use Doctrine\ORM\Mapping as ORM;
use Newscoop\Entity\Article;

/**
 * Rating entity
 * @ORM\Entity(repositoryClass="Newscoop\Entity\Repository\RatingRepository")
 * @ORM\Table(name="rating")
 */
class Rating extends AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", name="article_number")
     * @var int
     */
    private $articleId;

    /**
     * @ORM\Column(type="integer", name="user_id")
     * @var int
     */
    private $userId;

    /**
     * @ORM\Column(type="integer", name="rating_score")
     * @var int
     */
    private $ratingScore;

    /**
     * @ORM\Column(type="datetime", name="time_created")
     * @var DateTime
     */
    private $timeCreated;

    /**
     * @ORM\Column(type="datetime", name="time_updated")
     * @var DateTime
     */
    private $timeUpdated;

    /**
     * @return int
     */
    public function getArticleId()
    {
        return $this->articleId;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getRatingScore()
    {
        return $this->ratingScore;
    }

    /**
     * @return DateTime
     */
    public function getTimeCreated()
    {
        return $this->timeCreated;
    }

    /**
     * @return DateTime
     */
    public function getTimeUpdated()
    {
        return $this->timeUpdated;
    }

    /**
     * Set timecreated
     *
     * @param DateTime $p_datetime
     * @return Newscoop\Entity\Rating
     */
    public function setTimeCreated(\DateTime $p_datetime)
    {
        $this->timeCreated = $p_datetime;
        return $this;
    }

    /**
     * Set timeupdated
     *
     * @param DateTime $p_datetime
     * @return Newscoop\Entity\Rating
     */
    public function setTimeUpdated(\DateTime $p_datetime)
    {
        $this->timeUpdated = $p_datetime;
        return $this;
    }

    /**
     * Set articleId
     *
     * @param int $articleId
     * @return Newscoop\Entity\Rating
     */
    public function setArticleId($articleId)
    {
        $this->articleId = $articleId;
        return $this;
    }

    /**
     * Set userId
     *
     * @param int $userId
     * @return Newscoop\Entity\Rating
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * Set ratingScore
     *
     * @param int $ratingScore
     * @return Newscoop\Entity\Rating
     */
    public function setRatingScore($ratingScore)
    {
        $this->ratingScore = $ratingScore;
        return $this;
    }
}
