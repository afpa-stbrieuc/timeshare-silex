<?php

namespace Annonces\Entities;

use JsonSerializable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use DateTime;

/** @ODM\Document */
class Annonce implements JsonSerializable
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $name;

    public function __construct($name) {
     	$this->name = $name; 
 	}

    public function getName() {
    	return $this->name;
    }

    public function getId() {
    	return $this->id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function jsonSerialize()
    {
    	
        return array(
            'id' => $this->id,
            'name' => $this->name
        );
    }


}