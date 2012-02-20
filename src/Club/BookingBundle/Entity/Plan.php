<?php

namespace Club\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Club\BookingBundle\Entity\Plan
 *
 * @ORM\Table(name="club_booking_plan")
 * @ORM\Entity(repositoryClass="Club\BookingBundle\Entity\PlanRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Plan
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var date $period_start
     *
     * @ORM\Column(type="datetime")
     */
    protected $period_start;

    /**
     * @var date $period_end
     *
     * @ORM\Column(type="datetime")
     */
    protected $period_end;

    /**
     * @var date $first_date
     *
     * @ORM\Column(type="datetime")
     */
    protected $first_date;

    /**
     * @var date $end_date
     *
     * @ORM\Column(type="datetime")
     */
    protected $end_date;

    /**
     * @var date $name
     *
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var date $description
     *
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @var datetime $created_at
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $created_at;

    /**
     * @var datetime $updated_at
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity="Club\UserBundle\Entity\User")
     */
    protected $user;

    /**
     * @ORM\ManyToMany(targetEntity="Field")
     * @ORM\JoinTable(name="club_booking_plan_field",
     *   joinColumns={@ORM\JoinColumn(name="plan_id", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="field_id", referencedColumnName="id")}
     * )
     */
    protected $fields;


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
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set user
     *
     * @param Club\UserBundle\Entity\User $user
     */
    public function setUser(\Club\UserBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Club\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
      $this->setCreatedAt(new \DateTime());
      $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
      $this->setUpdatedAt(new \DateTime());
    }

    /**
     * Set first_date
     *
     * @param datetime $firstDate
     */
    public function setFirstDate($firstDate)
    {
        $this->first_date = $firstDate;
    }

    /**
     * Get first_date
     *
     * @return datetime
     */
    public function getFirstDate()
    {
        return $this->first_date;
    }

    /**
     * Set end_date
     *
     * @param datetime $endDate
     */
    public function setEndDate($endDate)
    {
        $this->end_date = $endDate;
    }

    /**
     * Get end_date
     *
     * @return datetime
     */
    public function getEndDate()
    {
        return $this->end_date;
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
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text
     */
    public function getDescription()
    {
        return $this->description;
    }
    public function __construct()
    {
        $this->fields = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add fields
     *
     * @param Club\BookingBundle\Entity\Field $fields
     */
    public function addField(\Club\BookingBundle\Entity\Field $fields)
    {
        $this->fields[] = $fields;
    }

    /**
     * Get fields
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getFields()
    {
        return $this->fields;
    }

    public function toArray()
    {
      $res = array(
        'id' => $this->getId(),
        'type' => 'plan',
        'name' => $this->getName(),
        'description' => $this->getDescription(),
        'first_date' => $this->getFirstDate()->format('c'),
        'end_date' => $this->getEndDate()->format('c'),
        'fields' => array()
      );

      foreach ($this->getFields() as $field) {
        $res['fields'][] = $field->toArray();
      }

      return $res;
    }

    /**
     * Set period_start
     *
     * @param datetime $periodStart
     */
    public function setPeriodStart($periodStart)
    {
        $this->period_start = $periodStart;
    }

    /**
     * Get period_start
     *
     * @return datetime 
     */
    public function getPeriodStart()
    {
        return $this->period_start;
    }

    /**
     * Set period_end
     *
     * @param datetime $periodEnd
     */
    public function setPeriodEnd($periodEnd)
    {
        $this->period_end = $periodEnd;
    }

    /**
     * Get period_end
     *
     * @return datetime 
     */
    public function getPeriodEnd()
    {
        return $this->period_end;
    }
}