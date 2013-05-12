<?php

namespace Kendoctor\Bundle\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
 
/**
 * QuestionItem
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"QuestionItem" = "QuestionItem", "ChoiceItem" = "ChoiceItem", "SingleChoiceItem" = "SingleChoiceItem", "MultipleChoiceItem" = "MultipleChoiceItem",})
 */
abstract class QuestionItem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="text")
     */
    protected $subject;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    protected $createdAt;

    /**
     *
     * @var type 
     * @ORM\OneToMany(targetEntity="ItemGroupItem", mappedBy="QuestionItem")
     * 
     */
    protected $ItemGroupItems;
    
    
    public function __construct()
    {
        $this->createdAt = new \DateTime;
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
     * Set subject
     *
     * @param string $subject
     * @return QuestionItem
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    
        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return QuestionItem
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
     * Add ItemGroupItems
     *
     * @param \Kendoctor\Bundle\TestBundle\Entity\ItemGroupItem $itemGroupItems
     * @return ChoiceItem
     */
    public function addItemGroupItem(\Kendoctor\Bundle\TestBundle\Entity\ItemGroupItem $itemGroupItems)
    {
        $this->ItemGroupItems[] = $itemGroupItems;
    
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
