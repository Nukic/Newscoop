<?php

namespace Proxy\__CG__\Newscoop\Entity\User;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Ip extends \Newscoop\Entity\User\Ip implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function setUser(\Newscoop\Entity\User $user)
    {
        $this->__load();
        return parent::setUser($user);
    }

    public function setIp($ip)
    {
        $this->__load();
        return parent::setIp($ip);
    }

    public function getIp()
    {
        $this->__load();
        return parent::getIp();
    }

    public function setNumber($number)
    {
        $this->__load();
        return parent::setNumber($number);
    }

    public function getNumber()
    {
        $this->__load();
        return parent::getNumber();
    }

    public function __toString()
    {
        $this->__load();
        return parent::__toString();
    }

    public function getUserId()
    {
        $this->__load();
        return parent::getUserId();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'ip', 'number', 'user');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields AS $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}