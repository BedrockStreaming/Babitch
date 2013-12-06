<?php

namespace Cytron\Bundle\BabitchBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;

use Cytron\Bundle\BabitchBundle\Entity\AbstractEntity;

/**
 * Abstract manager
 */
class BaseManager
{
    /**
     * Entity manager
     *
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Entity Name
     *
     * @var null|string
     */
    protected $entityName;

    /**
     * Entity Name
     *
     * @var ClassMetadata
     */
    protected $entityMetadata = null;

    /**
     * Constructor
     *
     * @param EntityManager $entityManager entity manager
     * @param string        $entityName    entity name
     */
    public function __construct(EntityManager $entityManager, $entityName)
    {
        $this->entityManager = $entityManager;
        $this->entityName    = $entityName;
    }

    /**
     * Get entity manager
     *
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Get entity name
     *
     * @return string
     */
    public function getEntityName()
    {
        return $this->entityName;
    }

    /**
     * Get entity metadata
     *
     * @return ClassMetadata
     */
    public function getEntityMetadata()
    {
        if ($this->entityMetadata === null) {
            $this->entityMetadata = $this->getEntityManager()->getClassMetadata($this->getEntityName());
        }

        return $this->entityMetadata;
    }

    /**
     * Get entity namespace
     *
     * @return string
     */
    public function getEntityNamespace()
    {
        return $this->getEntityMetadata()->getName();
    }

    /**
     * Get entity repository
     *
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->getEntityManager()->getRepository($this->entityName);
    }

    /**
     * Create a new entity
     *
     * @return AbstractEntity New entity
     */
    public function create()
    {
        $entityNamespace = $this->getEntityNamespace();

        return new $entityNamespace;
    }

    /**
     * Detach an Entity from the entity manager
     *
     * @param AbstractEntity $entity Entity to detach
     *
     * @return $this
     */
    public function detach(AbstractEntity $entity)
    {
        $this->getEntityManager()->detach($entity);

        return $this;
    }

    /**
     * Merge a detached Entity into entity manager
     *
     * @param AbstractEntity $entity Entity to merge
     *
     * @return $this
     */
    public function merge(AbstractEntity $entity)
    {
        $this->getEntityManager()->merge($entity);

        return $this;
    }

    /**
     * Prepare a Entity to be saved on the database
     *
     * @param AbstractEntity $entity Entity to persist
     * @param boolean        $flush  Whether or not flush entity changes immediately
     *
     * @return $this
     */
    public function persist(AbstractEntity $entity, $flush = false)
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->flush($entity);
        }

        return $this;
    }

    /**
     * Flush the changes on the database
     *
     * @param AbstractEntity|null $entity Entity to save
     *
     * @return $this
     */
    public function flush(AbstractEntity $entity = null)
    {
        $this->getEntityManager()->flush($entity);

        return $this;
    }

    /**
     * Prepare a Entity to be removed from the database
     *
     * @param AbstractEntity $entity Entity to remove
     * @param boolean        $flush  Whether or not flush entity changes immediately
     *
     * @return $this
     */
    public function remove(AbstractEntity $entity, $flush = false)
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->flush($entity);
        }

        return $this;
    }
}
