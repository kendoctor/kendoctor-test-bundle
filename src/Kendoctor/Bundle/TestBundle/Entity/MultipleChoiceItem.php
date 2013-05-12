<?php

namespace Kendoctor\Bundle\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kendoctor\Bundle\TestBundle\Entity\ChoiceItem;

/**
 * MultipleChoiceItem
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class MultipleChoiceItem extends ChoiceItem
{
  
    public function __construct()
    {
        parent::__construct();
        $this->isSingle = false;       
    }

}
