<?php

namespace Kendoctor\Bundle\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemGroup
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kendoctor\Bundle\TestBundle\Entity\ItemGroupRepository")
 */
class ItemGroup
{
   
    const SINGLE_CHOICE = "SINGLE_CHOICE";
    const MULTIPLE_CHOICE = "MULTIPLE_CHOICE";
    const TRUE_OR_FALSE = "TRUE_OR_FALSE";
    const FILLING_BLANK = "FILLING_BLANK";
 
    static $typeDescriptions = array(
        'SINGLE_CHOICE' => '单选题',
        'MULTIPLE_CHOICE' => '多选题',
        'TRUE_OR_FALSE' => '判断题',
        'FILLING_BLANK' => '填空题'
    );
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creaetedAt", type="datetime")
     */
    private $creaetedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20)
     */
    private $type;

    
    /**
     * 
     * @var Kendoctor\Bundle\TestBundle\Entity\Paper Paper
     * 
     * @ORM\ManyToOne(targetEntity="Paper", inversedBy="ItemGroups")
     * @ORM\JoinColumn(name="paper_id", referencedColumnName="id")
     */
    private $Paper;
    
    
    /**
     *
     * @var type 
     * @ORM\OneToMany(targetEntity="ItemGroupItem", mappedBy="ItemGroup", cascade={"all"})
     * 
     */
    private $ItemGroupItems;
    
   
    /**
     * constructor
     */
    public function __construct()
    {
        $this->creaetedAt = new \DateTime();
        $this->type = ItemGroup::SINGLE_CHOICE;
        $this->weight = 0;
        $this->ItemGroupItems =  new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set description
     *
     * @param string $description
     * @return ItemGroup
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set creaetedAt
     *
     * @param \DateTime $creaetedAt
     * @return ItemGroup
     */
    public function setCreaetedAt($creaetedAt)
    {
        $this->creaetedAt = $creaetedAt;
    
        return $this;
    }

    /**
     * Get creaetedAt
     *
     * @return \DateTime 
     */
    public function getCreaetedAt()
    {
        return $this->creaetedAt;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return ItemGroup
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
     * Set type
     *
     * @param string $type
     * @return ItemGroup
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
    
    public function getTypeDesc()
    {
       return  self::$typeDescriptions[$this->type];
         
    }

    /**
     * Set Paper
     *
     * @param \Kendoctor\Bundle\TestBundle\Entity\Paper $paper
     * @return ItemGroup
     */
    public function setPaper(\Kendoctor\Bundle\TestBundle\Entity\Paper $paper = null)
    {
        $this->Paper = $paper;
    
        return $this;
    }

    /**
     * Get Paper
     *
     * @return \Kendoctor\Bundle\TestBundle\Entity\Paper 
     */
    public function getPaper()
    {
        return $this->Paper;
    }

    /**
     * Add ItemGroupItems
     *
     * @param \Kendoctor\Bundle\TestBundle\Entity\ItemGroupItem $itemGroupItems
     * @return ItemGroup
     */
    public function addItemGroupItem(\Kendoctor\Bundle\TestBundle\Entity\ItemGroupItem $itemGroupItems)
    {
        $this->ItemGroupItems[] = $itemGroupItems;
        $itemGroupItems->setItemGroup($this);
        return $this;
    }

    /**
     * Remove ItemGroupItems
     *
     * @param \Kendoctor\Bundle\TestBundle\Entity\ItemGroupItem $itemGroupItems
     */
    public function removeItemGroupItem(\Kendoctor\Bundle\TestBundle\Entity\ItemGroupItem $itemGroupItems)
    {
        $this->ItemGroupItems->removeElement($itemGroupItems);
    }

    
    public function setItemGroupItems(\Doctrine\Common\Collections\Collection $itemGroupItems)
    {
        foreach($itemGroupItems as $itemGroupItem)
        {
            $this->addItemGroupItem($itemGroupItem);
        }
    }
    
    /**
     * Get ItemGroupItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItemGroupItems()
    {
        return $this->ItemGroupItems;
    }
}