<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;


class ActiviteSearch
{
     /**
     * @var int|null
     */
   private $maxPrice;

   /**
     * @Assert\Range(min = 2,max = 12 )
     * @var int|null
     */
    private $minDuration;

   /**
     * @return  int|null
     */ 
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param  int|null  $maxPrice
     *
     * @return  ActiviteSearch
     */ 
    public function setMaxPrice(int $maxPrice): ActiviteSearch
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * @return  int|null
     */ 
    public function getMinDuration(): ?int
    {
        return $this->minDuration;
    }

    /**
     * @param  int|null  $minDuration
     *
     * @return  ActiviteSearch
     */ 
    public function setMinDuration(int $minDuration): ActiviteSearch
    {
        $this->minDuration = $minDuration;

        return $this;
    }
   
}