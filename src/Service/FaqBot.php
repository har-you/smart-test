<?php


namespace App\Service;


use App\Entity\Question;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Log\Logger;

class FaqBot
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(EntityManagerInterface $em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    /**
     * @param Question $question
     */
    public function save(Question $question): void
    {
        if ($question->getId() === null) {
            $this->em->persist($question);
        }

        $this->em->flush();
    }

    /**
     * retrieve Question By Id
     *
     * @param int $id
     *
     * @return Question
     */
    public function retrieveQuestion(int $id): Question
    {
        /** @var Question $question */
        $question = $this->em->getRepository(Question::class)->find($id) ;
        if ($question === null) {
            $this->logger->error('Unfound Question', ['id' => $id]);
            throw new NotFoundHttpException('Unfound Question');
        }

        return $question;
    }
}