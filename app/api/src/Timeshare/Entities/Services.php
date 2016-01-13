<?php
namespace Timeshare\Entities;

use JsonSerializable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use DateTime;

/** @ODM\Document */
class Services implements JsonSerializable
{
    /** @ODM\Id */
    private $id;
    
    /** @ODM\Field(type="string") */
    private $name;
     
    /** @ODM\Field(type="int") */
    private $time;
    
    /** @ODM\Field(type="int") */
    private $note;
            
            
    function __construct($name, $time, $note) {
   
        $this->name = $name;
        $this->time = $time;
        $this->note = $note;
    }
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getTime() {
        return $this->time;
    }

    function getNote() {
        return $this->note;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setTime($time) {
        $this->time = $time;
    }

    function setNote($note) {
        $this->note = $note;
    }

    
    
        public function jsonSerialize() {
             return array(
            'id' => $this->id,
            'name' => $this->name,
            'time' => $this->time,
            'note' => $this->note     
        );
        
    }

}

