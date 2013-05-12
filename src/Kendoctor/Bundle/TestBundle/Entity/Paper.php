<?php

namespace Kendoctor\Bundle\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paper
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kendoctor\Bundle\TestBundle\Entity\PaperRepository")
 */
class Paper
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
     * @ORM\Column(name="title", type="string", length=50)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isPublished", type="boolean")
     */
    private $isPublished;


    /**
     *
     * @var Kendoctor\Bundle\TestBundle\Entity\ItemGroup ItemGroups
     * 
     * @ORM\OneToMany(targetEntity="ItemGroup", mappedBy="Paper", cascade={"all"})
     */
    private $ItemGroups;
    
    
    
    public function __construct()
    {
        $this->isPublished = false;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();        
        $this->ItemGroups = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Paper
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Paper
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Paper
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Paper
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set isPublished
     *
     * @param boolean $isPublished
     * @return Paper
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;
    
        return $this;
    }

    /**
     * Get isPublished
     *
     * @return boolean 
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * Add ItemGroups
     *
     * @param \Kendoctor\Bundle\TestBundle\Entity\ItemGroup $itemGroup
     * @return Paper
     */
    public function addItemGroup(\Kendoctor\Bundle\TestBundle\Entity\ItemGroup $itemGroup)
    {
        $this->ItemGroups[] = $itemGroup;
        $itemGroup->setPaper($this);
        return $this;
    }

    /**
     * Remove ItemGroups
     *
     * @param \Kendoctor\Bundle\TestBundle\Entity\ItemGroup $itemGroups
     */
    public function removeItemGroup(\Kendoctor\Bundle\TestBundle\Entity\ItemGroup $itemGroups)
    {
        $this->ItemGroups->removeElement($itemGroups);
    }

    /**
     * Get ItemGroups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItemGroups()
    {
        return $this->ItemGroups;
    }

    public function setItemGroups(\Doctrine\Common\Collections\Collection  $itemGroups)
    {
        foreach($itemGroups as $itemGroup)
        {
            $this->addItemGroup($itemGroup);
        }        
    }

    public function __toString()
    {
        return $this->title;
    }
    
}