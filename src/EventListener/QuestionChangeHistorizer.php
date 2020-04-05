<?php


namespace App\EventListener;

use App\Entity\Question;
use App\Entity\QuestionHistoric;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Psr\Log\LoggerInterface;

class QuestionChangeSubscriber implements EventSubscriber
{
    const FIELDS_TO_HISTORIZE = ['title', 'status'];

    /** @var LoggerInterface  */
    private $logger;

    /**
     * QuestionChangeSubscriber constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::postUpdate,
        ];
    }

    /**
     * @param LifecycleEventArgs $args
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->logger->info('postUpdate');
        $entity = $args->getObject();
        $em = $args->getEntityManager();

        if (! $entity instanceof Question) {
            return;
        }

        $changeSet = $args->getEntityManager()->getUnitOfWork()->getEntityChangeSet($entity);

        foreach ($changeSet as $field => $change) {
            if (in_array($field, self::FIELDS_TO_HISTORIZE)) {
                $this->logger->info($field.' changed');
                $questionHistoric = new QuestionHistoric();
                $questionHistoric->setField($field);
                $questionHistoric->setUpdated(new \DateTime());
                $questionHistoric->setQuestionId($entity->getId());
                $questionHistoric->setNewValue($change[1]);
                $questionHistoric->setOldValue($change[0]);

                $em->persist($questionHistoric);
            }
        }

        $em->flush();
    }
}
