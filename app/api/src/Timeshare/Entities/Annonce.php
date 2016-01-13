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
    
    /** @ODM\ReferenceOne(targetDocument="User") */
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
    private $date_validite_debut;
    
    /** @ODM\Field(type="date") */
    private $date_validite_fin;
    
    /** @ODM\Field(type="boolean") */
    private $demande;

    public function __construct($name, $user, $date_validite_debut, $date_validite_fin, $location, $category) {
     	$this->name = $name;
     	$this->user = $user;
     	$this->date = new DateTime("now");
     	//$this->date_validite_debut = DateTime::createFromFormat("Y-m-d H:i:s", $date_validite_debut);
     	//$this->date_validite_fin = DateTime::createFromFormat("Y-m-d H:i:s", $date_validite_fin);
     	$this->date_validite_debut =  $date_validite_debut;
     	$this->date_validite_fin = $date_validite_fin;
     	$this->location = $location;
     	$this->category = $category;
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
	public function getDate() {
		return $this->date;
	}
	public function setDate($date) {
		$this->date = $date;
	}
	public function setDateValiditeDebut($date) {
		$this->date_validite_debut = $date;
	}
	public function getDateValiditeDebut($date) {
		return $this->date_validite_debut;
	}
	public function setDateValiditeFin($date) {
		$this->date_validite_fin = $date;
	}
	public function getDateValiditeFin($date) {
		return $this->date_validite_fin;
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
    public function jsonSerialize()
    {
        return array(
            '_id' => $this->id,
            'name' => $this->name,
        	'user' => $this->user->getId(),
        	'date' => date_format($this->date, 'Y-m-d H:i:s'),
        	'demande' => $this->demande,
        	'location' => $this->location,
        	'category' => $this->category,
        	'date_validite_debut' => date_format($this->date_validite_debut, 'Y-m-d H:i:s'),
        	'date_validite_fin' => date_format($this->date_validite_fin, 'Y-m-d H:i:s')
        );
    }


}