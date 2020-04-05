<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class QuestionHistoricRepository
 */
class QuestionHistoricRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function getDataForExport()
    {
        $qb = $this->createQueryBuilder('qh')
            ->select(['qh.field','qh.oldValue','qh.newValue', 'date_format(qh.updated , \'%Y-%m-%d %H:%i:%s\')']);

        return $qb->getQuery()->getArrayResult();
    }
}
