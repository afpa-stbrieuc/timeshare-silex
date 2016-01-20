<?php
namespace Timeshare\Entities;

use JsonSerializable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use DateTime;

use Timeshare\Entities\Annonce;
use Timeshare\Entities\User;

/** @ODM\Document */
class Services implements JsonSerializable
{
    /** @ODM\Id */
    private $id;
     
    /** @ODM\Field(type="int") */
    private $time;
    
    /** @ODM\Field(type="int") */
    private $note;
    
    /** @ODM\ReferenceOne(targetDocument="User", simple=true) */
    private $debiteur;
    
    /** @ODM\ReferenceOne(targetDocument="User",simple=true) */
    private $crediteur;
    
     /** @ODM\ReferenceOne(targetDocument="Annonce", simple=true) */
    private $annonce;
            
            
    function __construct(User $debiteur, User $crediteur, Annonce $annonce, $note, $time) {

        $this->debiteur = $debiteur;
        $this->crediteur = $crediteur;
        $this->annonce = $annonce;
        $this->time = $time;
        $this->note = $note;
    }
    
    function getId() {
        return $this->id;
    }

    function getTime() {
        return $this->time;
    }

    function getNote() {
        return $this->note;
    }

    function getDebiteur() {
        return $this->debiteur;
    }

    function getCrediteur() {
        return $this->crediteur;
    }

    function getAnnonce() {
        return $this->annonce;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTime($time) {
        $this->time = $time;
    }

    function setNote($note) {
        $this->note = $note;
    }

    function setDebiteur($debiteur) {
        $this->debiteur = $debiteur;
    }

    function setCrediteur($crediteur) {
        $this->crediteur = $crediteur;
    }

    function setAnnonce($annonce) {
        $this->annonce = $annonce;
    }

    public function jsonSerialize() {
         
        return array(
            'id' => $this->id,
            'name' => $this->annonce->getName(),
            'debiteur' => $this->debiteur,
            'crediteur' => $this->crediteur, 
            'annonce'=>$this->annonce,     
            'time' => $this->time,
            'note' => $this->note,  
        );
        
    }

}

