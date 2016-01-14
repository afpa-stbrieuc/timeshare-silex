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
        $this->timebalance = $timebalance;
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




#faut que tu lui envoies la valeur a changer dans $firstname
    public function setFirstname($firstname) {
        return $this->firstname = $firstname;
    }

    public function setSurname($surname) {
        return $this->surname = $surname;
    }

    public function setTown($town) {
        return $this->town = $town;
    }

    public function setTimeBalance($timebalance) {
        return $this->timebalance = $timebalance;
    }




    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,          
            'surname' => $this->surname,
            'firstname' => $this->firstname,
            'town' => $this->town,
            'timebalance' => $this->timebalance);
    }


}