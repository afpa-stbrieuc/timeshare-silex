<?php

namespace DoctrineMongoDBProxy\__CG__\Timeshare\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Annonce extends \Timeshare\Entities\Annonce implements \Doctrine\ODM\MongoDB\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'id', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'user', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'name', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'date', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'location', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'category', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'dateValiditeDebut', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'dateValiditeFin', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'demande');
        }

        return array('__isInitialized__', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'id', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'user', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'name', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'date', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'location', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'category', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'dateValiditeDebut', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'dateValiditeFin', '' . "\0" . 'Timeshare\\Entities\\Annonce' . "\0" . 'demande');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Annonce $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getName', array());

        return parent::getName();
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setName', array($name));

        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setUser($user)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUser', array($user));

        return parent::setUser($user);
    }

    /**
     * {@inheritDoc}
     */
    public function getUser()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUser', array());

        return parent::getUser();
    }

    /**
     * {@inheritDoc}
     */
    public function getDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDate', array());

        return parent::getDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setDate($date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDate', array($date));

        return parent::setDate($date);
    }

    /**
     * {@inheritDoc}
     */
    public function setDateValiditeDebut($date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateValiditeDebut', array($date));

        return parent::setDateValiditeDebut($date);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateValiditeDebut()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateValiditeDebut', array());

        return parent::getDateValiditeDebut();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateValiditeFin($date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateValiditeFin', array($date));

        return parent::setDateValiditeFin($date);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateValiditeFin()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateValiditeFin', array());

        return parent::getDateValiditeFin();
    }

    /**
     * {@inheritDoc}
     */
    public function getDemande()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDemande', array());

        return parent::getDemande();
    }

    /**
     * {@inheritDoc}
     */
    public function setDemande($demande)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDemande', array($demande));

        return parent::setDemande($demande);
    }

    /**
     * {@inheritDoc}
     */
    public function getLocation()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLocation', array());

        return parent::getLocation();
    }

    /**
     * {@inheritDoc}
     */
    public function setLocation($location)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLocation', array($location));

        return parent::setLocation($location);
    }

    /**
     * {@inheritDoc}
     */
    public function setCategory($category)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCategory', array($category));

        return parent::setCategory($category);
    }

    /**
     * {@inheritDoc}
     */
    public function getCategory()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCategory', array());

        return parent::getCategory();
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'jsonSerialize', array());

        return parent::jsonSerialize();
    }

}