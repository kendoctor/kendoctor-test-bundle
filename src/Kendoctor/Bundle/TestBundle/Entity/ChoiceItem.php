<?php

namespace Kendoctor\Bundle\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kendoctor\Bundle\TestBundle\Entity\QuestionItem;

/**
 * ChoiceItem
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kendoctor\Bundle\TestBundle\Entity\ChoiceItemRepository")
 */
abstract class ChoiceItem extends QuestionItem
{
   
    /**
     * @var boolean
     *
     * @ORM\Column(name="isSingle", type="boolean")
     */
    protected $isSingle;
    
 

    /**
     *
     * @var type 
     * @ORM\OneToMany(targetEntity="ChoiceItemAnswer", mappedBy="ChoiceItem", cascade={"all"})
     */
    private $ChoiceItemAnswers;
    
    public function __construct()
    {
        parent::__construct();
        $this->ChoiceItemAnswers =  new \Doctrine\Common\Collections\ArrayCollection();
       
    }
  

    /**
     * Set isSingle
     *
     * @param boolean $isSingle
     * @return ChoiceItem
     */
    public function setIsSingle($isSingle)
    {
        $this->isSingle = $isSingle;
    
        return $this;
    }

    /**
     * Get isSingle
     *
     * @return boolean 
     */
    public function getIsSingle()
    {
        return $this->isSingle;
    }

   

    /**
     * Add ChoiceItemAnswers
     *
     * @param \Kendoctor\Bundle\TestBundle\Entity\ChoiceItemAnswer $choiceItemAnswers
     * @return ChoiceItem
     */
    public function addChoiceItemAnswer(\Kendoctor\Bundle\TestBundle\Entity\ChoiceItemAnswer $choiceItemAnswers)
    {
        $this->ChoiceItemAnswers[] = $choiceItemAnswers;
        $choiceItemAnswers->setChoiceItem($this);
        return $this;
    }

    /**
     * Remove ChoiceItemAnswers
     *
     * @param \Kendoctor\Bundle\TestBundle\Entity\ChoiceItemAnswer $choiceItemAnswers
     */
    public function removeChoiceItemAnswer(\Kendoctor\Bundle\TestBundle\Entity\ChoiceItemAnswer $choiceItemAnswers)
    {
        $this->ChoiceItemAnswers->removeElement($choiceItemAnswers);
    }

    /**
     * Get ChoiceItemAnswers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function setChoiceItemAnswers(\Doctrine\Common\Collections\Collection $choiceItemAnswers)
    {
        foreach($choiceItemAnswers as $choiceItemAnswer)
        {
            $this->addChoiceItemAnswer($choiceItemAnswer);
        }        
    }
    
    /**
     * Get ChoiceItemAnswers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChoiceItemAnswers()
    {
        return $this->ChoiceItemAnswers;
    }
}