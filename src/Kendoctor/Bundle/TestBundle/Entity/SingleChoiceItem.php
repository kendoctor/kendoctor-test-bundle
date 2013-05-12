<?php

namespace Kendoctor\Bundle\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kendoctor\Bundle\TestBundle\Entity\ChoiceItem;

/**
 * SingleChoiceItem
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class SingleChoiceItem extends ChoiceItem
{
 
    private $correctAnswerOptions;
    
    public function __construct()
    {
        parent::__construct();
        $this->isSingle = true;   
        $this->correctAnswerOptions = 0;        
    }

    public function getCorrectAnswerOptions(){
        return $this->correctAnswerOptions;
    }
    public function setCorrectAnswerOptions($correctAnswerOptions){
        $this->correctAnswerOptions = $correctAnswerOptions;
    }
}
