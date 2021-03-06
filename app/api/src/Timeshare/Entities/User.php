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
    private $pseudo;

      /** @ODM\Field(type="string") */
    private $password;

    /** @ODM\Field(type="string") */
    private $surname;

    /** @ODM\Field(type="string") */
    private $firstname;

    /** @ODM\Field(type="string") */
    private $address;

    /** @ODM\Field(type="string") */
    private $town;        

    /** @ODM\Field(type="int") */
    private $timebalance;

    /** @ODM\Field(type="string") */
    private $email;

#fait le contructeur d'un objet (ici user et construit ses attributs). nom prenom
    public function __construct($pseudo, $password, $surname, $firstname, $address, $town, $email) {
        $this->pseudo             = $pseudo;
        $this->password           = $password;
        $this->surname            = $surname;
        $this->firstname          = $firstname;
        $this->town               = $town;
        $this->timebalance        = 120;
        $this->address            = $address;
        $this->email              = $email;
 	}

    public function getId() {
        return $this->id;
    }

    public function getPassword() {
        return $this->password;
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

    public function getPseudo() {
        return $this->pseudo;
    }

    public function getAddress() {
        return $this->address;
    }    

    public function getEmail() {
        return $this->email;
    }

    public function setPassword($password) {
        return $this->password = $password;
    }

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

    public function setEmail($email) {
        return $this->email = $email;
    }

    public function setAddress($address) {
        return $this->address = $address;
    }

    public function setPseudo($pseudo) {
        return $this->pseudo = $pseudo;
    }

    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'pseudo' => $this->pseudo,
            'password' => $this->password,
            'surname' => $this->surname,
            'firstname' => $this->firstname,
            'address' => $this->address,
            'town' => $this->town,
            'timebalance' => $this->timebalance,
            'email' => $this->email);
    }


}