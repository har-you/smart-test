<?php

namespace App\Command;

use App\Entity\QuestionHistoric;
use App\Service\Export\Exporter;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ExportQuestionHistoricCommand
 */
class ExportQuestionHistoricCommand extends Command
{
    /** @var EntityManagerInterface  */
    private $em;

    /** @var Exporter */
    private $exporter;

    /** @var LoggerInterface */
    private $logger;

    /**
     * ExportQuestionHistoricCommand constructor.
     *
     * @param EntityManagerInterface $em
     * @param Exporter               $exporter
     * @param LoggerInterface        $logger
     */
    public function __construct(EntityManagerInterface $em, Exporter $exporter, LoggerInterface $logger)
    {
        parent::__construct();

        $this->em = $em;
        $this->exporter = $exporter;
        $this->logger = $logger;
    }

    /**
     * {@inheritDoc}
     */
    protected function configure(): void
    {
        $this->setName('smart:export:qa-historic')
        ->setDescription('Export Q&A historic changes')
        ->addOption('format', 'format',InputOption::VALUE_REQUIRED, 'Specify the export format, CSV by default', 'csv')
        ->setHelp(<<<'HELP'
The <info>%command.name%</info> Export of all changes of questions that are stored in database:



You can specify the format of the export, by default export format is csv, if a format is not supported an error will be logged
the email address specified in the <comment>--format</comment> option:

  <info>php %command.full_name%</info> <comment>--format=csv</comment>

HELP)
            ;
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $data = $this->em->getRepository(QuestionHistoric::class)->getDataForExport();
            $this->exporter->export(strtolower($input->getOption('format')), $data);

            return 0;
        } catch (\Exception $e) {
            $this->logger->error('An error has been occured', ['msg' => $e->getMessage()]);
        }

         return 1;
    }
}
