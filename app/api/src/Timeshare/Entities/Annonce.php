<?php

namespace Timeshare\Entities;

use JsonSerializable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use DateTime;

/** @ODM\Document */
class Annonce implements JsonSerializable
{
    /** @ODM\Id */
    private $id;
    
    /** @ODM\ReferenceOne(targetDocument="User", simple=true) */
    private $user;
    
    /** @ODM\Field(type="string") */
    private $name;
    
    /** @ODM\Field(type="date") */
    private $date;
    
    /** @ODM\Field(type="string") */
    private $location;
    
    /** @ODM\Field(type="string") */
    private $category;
    
    /** @ODM\Field(type="date") */
    private $dateValiditeDebut;
    
    /** @ODM\Field(type="string") */
    private $description;
    
    /** @ODM\Field(type="date") */
    private $dateValiditeFin;
    
    /** @ODM\Field(type="boolean") */
    private $demande;

    public function __construct($name, User $user, $description, $dateValiditeDebut, $dateValiditeFin, $location, $category, $demande) {
     	$this->name = $name;
     	$this->user = $user;
        $this->description = $description;
     	$this->date = new DateTime('now');
     	//$this->dateValiditeDebut = DateTime::createFromFormat('Y-m-d H:i:s', $dateValiditeDebut);
     	//$this->dateValiditeFin = DateTime::createFromFormat('Y-m-d H:i:s', $dateValiditeFin);
     	$this->dateValiditeDebut =  $dateValiditeDebut;
     	$this->dateValiditeFin = $dateValiditeFin;
     	$this->location = $location;
     	$this->category = $category;
     	$this->demande = $demande;
 	}
         
    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
         
    public function getName() {
    	return $this->name;
    }
    public function setName($name){
    	$this->name = $name;
    }
    public function getId() {
    	return $this->id;
    }
    public function setUser($user) {
    	$this->user = $user;
    }
    public function getUser() {
    	return $this->user;
    }
	public function getDate() {
		return $this->date;
	}
	public function setDate($date) {
		$this->date = $date;
	}
	public function setDateValiditeDebut($date) {
		$this->dateValiditeDebut = $date;
	}
	public function getDateValiditeDebut() {
		return $this->dateValiditeDebut;
	}
	public function setDateValiditeFin($date) {
		$this->dateValiditeFin = $date;
	}
	public function getDateValiditeFin() {
		return $this->dateValiditeFin;
	}
	public function getDemande() {
		return $this->demande;
	}
	public function setDemande($demande) {
		$this->demande = $demande;
	}
	public function getLocation() {
		return $this->location;
	}
	public function setLocation($location) {
		$this->location = $location;
	}
	public function setCategory($category) {
		$this->category = $category;
	}
	public function getCategory() {
		return $this->category;
	}
	public function jsonSerialize() {
		return array(
				'id' => $this->id,
				'name' => $this->name,
				'user' => $this->user,
                                'description' => $this->description,
				'date' => date_format ( $this->date, 'Y-m-d H:i:s' ),
				'location' => $this->location,
				'category' => $this->category,
				'dateValiditeDebut' => date_format ( $this->dateValiditeDebut, 'Y-m-d H:i:s' ),
				'dateValiditeFin' => date_format ( $this->dateValiditeFin, 'Y-m-d H:i:s' ),
				'demande' => $this->demande,
		);
	}
}