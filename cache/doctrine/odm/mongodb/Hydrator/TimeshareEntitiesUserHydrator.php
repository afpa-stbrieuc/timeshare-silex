<?php

namespace DoctrineMongoDBHydrator;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Hydrator\HydratorInterface;
use Doctrine\ODM\MongoDB\UnitOfWork;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ODM. DO NOT EDIT THIS FILE.
 */
class TimeshareEntitiesUserHydrator implements HydratorInterface
{
    private $dm;
    private $unitOfWork;
    private $class;

    public function __construct(DocumentManager $dm, UnitOfWork $uow, ClassMetadata $class)
    {
        $this->dm = $dm;
        $this->unitOfWork = $uow;
        $this->class = $class;
    }

    public function hydrate($document, $data, array $hints = array())
    {
        $hydratedData = array();

        /** @Field(type="id") */
        if (isset($data['_id'])) {
            $value = $data['_id'];
            $return = $value instanceof \MongoId ? (string) $value : $value;
            $this->class->reflFields['id']->setValue($document, $return);
            $hydratedData['id'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['surname'])) {
            $value = $data['surname'];
            $return = (string) $value;
            $this->class->reflFields['surname']->setValue($document, $return);
            $hydratedData['surname'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['firstname'])) {
            $value = $data['firstname'];
            $return = (string) $value;
            $this->class->reflFields['firstname']->setValue($document, $return);
            $hydratedData['firstname'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['town'])) {
            $value = $data['town'];
            $return = (string) $value;
            $this->class->reflFields['town']->setValue($document, $return);
            $hydratedData['town'] = $return;
        }

        /** @Field(type="int") */
        if (isset($data['timebalance'])) {
            $value = $data['timebalance'];
            $return = (int) $value;
            $this->class->reflFields['timebalance']->setValue($document, $return);
            $hydratedData['timebalance'] = $return;
        }
        return $hydratedData;
    }
}