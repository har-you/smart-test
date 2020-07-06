<?php


namespace App\Repository;


use App\Dto\Search;
use Doctrine\ORM\EntityRepository;

class CelebrityRepository extends EntityRepository
{
    public function search(Search $search)
    {
        $qb = $this->createQueryBuilder('celebrity')
            ->leftJoin('celebrity.cemetery','cemetery')
            ->leftJoin('cemetery.city','city');

        if (!empty($search->firstLastname)) {
            $qb->andWhere('celebrity.lastFirstName like :lastFirstName')
                ->setParameter('lastFirstName', '%'.$search->firstLastname.'%');
        }

        if (!empty($search->cemetery)) {
            $qb->andWhere('cemetery.id = :cemetery')
                ->setParameter('cemetery', $search->cemetery);
        }

        if (!empty($search->nationality)) {
            $orX = $qb->expr()->orX();
            foreach($search->nationality as $index =>$nationality) {
                $orX->add('celebrity.nationality like :nationality'.$index);
            }
            $qb->andWhere($orX);
            foreach ($search->nationality as $index =>$nationality) {
                $qb->setParameter('nationality'.$index, '%'.$nationality.'%');
            }
        }

        if (!empty($search->nickName)) {
            $qb->andWhere('celebrity.nickName like :nickName')
                ->setParameter('nickName', '%'.$search->nickName.'%');
        }

        if (!empty($search->profession)) {
            $qb->andWhere('celebrity.profession like :profession')
                ->setParameter('profession', '%'.$search->profession.'%');
        }

        if (!empty($search->city)) {
            $qb->andWhere('city.id = :city')
                ->setParameter('city', $search->city->getId());
        }

        return $qb->getQuery()->getResult();
    }

    public function getNationalities()
    {
        $qb = $this->createQueryBuilder('celebrity')
            ->distinct()
            ->select('celebrity.nationality');

        $result = $qb->getQuery()->getArrayResult();
        $nationalities = [];
        foreach ($result as $item) {
            foreach ($item['nationality'] as $nationality) {
                if (!in_array($nationality, $nationalities)) {
                    $nationalities[] = $nationality;
                }
            }
        }

        return $nationalities;
    }

    public function getProfessions()
    {
        $qb = $this->createQueryBuilder('celebrity')
            ->distinct()
            ->select('celebrity.profession');

        $result = $qb->getQuery()->getArrayResult();
        $professions = [];
        foreach ($result as $item) {
            foreach ($item['profession'] as $profession) {
                if (!in_array($profession, $professions)) {
                    $professions[] = $profession;
                }
            }
        }

        return $professions;
    }
}