<?php

namespace AssureurBundle\Repository;

/**
 * DossierRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
use ApiUserBundle\Entity\User;
use Doctrine\ORM\NoResultException;

class DossierRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByUserId($user_id){
        $query = $this->createQueryBuilder('u')
            ->select('u,v')
            ->leftJoin('u.vehicule','v')
            ->where('u.id = :id')
            ->setParameter('id',$user_id);
        try{
            $query->getQuery()->getResult();
        }catch (NoResultException $e){
            return null;
        }

    }

    public function getOne($id){
        $q = $this->createQueryBuilder('d')
            ->select('d')
            ->where('d.id = :id')
            ->setParameter('id',$id)
            ->getQuery();
        try{
            return $q->getSingleResult();
        }catch (NoResultException $e){
            return null;
        }
    }
}
