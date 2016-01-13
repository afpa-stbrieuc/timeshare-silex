<?php

namespace Timeshare\Entities;

use JsonSerializable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use DateTime;

/** @ODM\Document */
class User implements JsonSerializable
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $surname;

    /** @ODM\Field(type="string") */
    private $firstname;

    /** @ODM\Field(type="string") */
    private $town;        

    /** @ODM\Field(type="int") */
    private $timebalance;




#fait le contructeur d'un objet (ici user et construit ses attributs). nom prenom
    public function __construct($surname, $firstname, $town, $timebalance) {
     	$this->surname            = $surname;
        $this->firstname          = $firstname;
        $this->town               = $town;
        $timebalance->timebalance = $timebalance;
 	}



    public function getId() {
        return $this->id;
    }

    public function getFirstname() {
    	return $this->firstname;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getTown() {
        return $this->town;
    }

    public function getTimeBalance() {
        return $this->timebalance;
    }





    public function setFirstname() {
        return $this->firstname;
    }

    public function setSurname() {
        return $this->surname;
    }

    public function setTown() {
        return $this->town;
    }

    public function setTimeBalance() {
        return $this->timebalance;
    }




    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'firstname' => $this->firstname,
            'surname' => $this->surname,
            'town' => $this->town,
            'timebalance' => $this->timebalance,
        );
    }


}