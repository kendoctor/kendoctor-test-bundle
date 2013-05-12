<?php

namespace Kendoctor\Bundle\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemGroupItem
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kendoctor\Bundle\TestBundle\Entity\ItemGroupItemRepository")
 */
class ItemGroupItem
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
     * @var integer
     *
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     *
     * @var type 
     * @ORM\ManyToOne(targetEntity="ItemGroup", inversedBy="ItemGroupItems")
     * @ORM\JoinColumn(name="item_group_id", referencedColumnName="id")
     */
    private $ItemGroup;
    
    /**
     *
     * @var type 
     * @ORM\ManyToOne(targetEntity="QuestionItem", inversedBy="ItemGroupItems", cascade={"all"})
     * @ORM\JoinColumn(name="question_item_id", referencedColumnName="id")
     */
    private $QuestionItem;

    
    public function __construct()
    {
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
     * Set weight
     *
     * @param integer $weight
     * @return ItemGroupItem
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ItemGroupItem
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
     * Set ItemGroup
     *
     * @param \Kendoctor\Bundle\TestBundle\Entity\ItemGroup $itemGroup
     * @return ItemGroupItem
     */
    public function setItemGroup(\Kendoctor\Bundle\TestBundle\Entity\ItemGroup $itemGroup = null)
    {
        $this->ItemGroup = $itemGroup;
    
        return $this;
    }

    /**
     * Get ItemGroup
     *
     * @return \Kendoctor\Bundle\TestBundle\Entity\ItemGroup 
     */
    public function getItemGroup()
    {
        return $this->ItemGroup;
    }

    /**
     * Set QuestionItem 
     *
     * @param \Kendoctor\Bundle\TestBundle\Entity\QuestionItem $questionItem
     * @return ItemGroupItem
     */
    public function setQuestionItem(\Kendoctor\Bundle\TestBundle\Entity\QuestionItem $questionItem = null)
    {
        $this->QuestionItem = $questionItem;
    
        return $this;
    }

    /**
     * Get QuestionItem 
     *
     * @return \Kendoctor\Bundle\TestBundle\Entity\QuestionItem 
     */
    public function getQuestionItem()
    {
        return $this->QuestionItem;
    }
}