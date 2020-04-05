<?php

namespace App\Service\Export;

use Psr\Log\LoggerInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class CsvExporter
 */
class CsvExporter implements ExporterInterface
{
    const DELIMTER = ';';

    /** @var LoggerInterface */
    private $logger;

    /** @var Filesystem  */
    private $filesystem;

    /** @var string  */
    private $exportDir;

    /**
     * CsvExporter constructor.
     *
     * @param LoggerInterface $logger
     * @param Filesystem $filesystem
     * @param string $exportDir
     */
    public function __construct(LoggerInterface $logger,Filesystem $filesystem, string $exportDir)
    {
        $this->logger = $logger;
        $this->filesystem = $filesystem;
        $this->exportDir = $exportDir;
    }

    /**
     * {@inheritDoc}
     */
    public function support(string $format): bool
    {
        return $format === 'csv';
    }

    /**
     * {@inheritDoc}
     */
    public function export(array $data): void
    {
        $this->logger->info('Export CSV Format Start');
        $headers = [];

        if (!$this->filesystem->exists($this->exportDir)) {
            $this->filesystem->mkdir($this->exportDir);
        }

        $handlerCsv = fopen($this->exportDir.DIRECTORY_SEPARATOR.'export.csv','rw+');

        foreach ($data as $index => $line) {
            if (empty($headers)) {
                $headers = array_keys($line);
                fputcsv($handlerCsv, $headers, self::DELIMTER);
            }
            fputcsv($handlerCsv, $line, self::DELIMTER);
        }

        $this->logger->info('Export CSV Format Start end');
    }
}
