<?php

namespace Kendoctor\Bundle\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChoiceItemAnswer
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ChoiceItemAnswer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="answer", type="text")
     */
    private $answer;

    /**
     * @var integer
     *
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isCorrect", type="boolean")
     */
    private $isCorrect;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     *
     * @var type 
     * @ORM\ManyToOne(targetEntity="ChoiceItem", inversedBy="ChoiceItemAnswers")
     * @ORM\JoinColumn(name="choice_item_id", referencedColumnName="id")
     */
    private $ChoiceItem;

    public function __construct()
    {
        $this->isCorrect = false;
        $this->createdAt = new \DateTime;
        $this->weight = 0;
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
     * Set answer
     *
     * @param string $answer
     * @return ChoiceItemAnswer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    
        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return ChoiceItemAnswer
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    
        return $this;
    }

    /**
     * Get weight
     *
     * @return integer 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set isCorrect
     *
     * @param boolean $isCorrect
     * @return ChoiceItemAnswer
     */
    public function setIsCorrect($isCorrect)
    {
        $this->isCorrect = $isCorrect;
    
        return $this;
    }

    /**
     * Get isCorrect
     *
     * @return boolean 
     */
    public function getIsCorrect()
    {
        return $this->isCorrect;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ChoiceItemAnswer
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set ChoiceItem
     *
     * @param \Kendoctor\Bundle\TestBundle\Entity\ChoiceItem $choiceItem
     * @return ChoiceItemAnswer
     */
    public function setChoiceItem(\Kendoctor\Bundle\TestBundle\Entity\ChoiceItem $choiceItem = null)
    {
        $this->ChoiceItem = $choiceItem;
    
        return $this;
    }

    /**
     * Get ChoiceItem
     *
     * @return \Kendoctor\Bundle\TestBundle\Entity\ChoiceItem 
     */
    public function getChoiceItem()
    {
        return $this->ChoiceItem;
    }
}