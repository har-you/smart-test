<?php

namespace App\Service\Export;

use Psr\Log\LoggerInterface;

class Exporter
{
    const CSV_EXPORT = 'csv';

    /** @var ExporterInterface[] */
    private $exporters;

    /** @var LoggerInterface */
    private $logger;

    /**
     * Exporter constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param ExporterInterface $exporter
     */
    public function addExporter(ExporterInterface $exporter)
    {
        $this->exporters[] = $exporter;
    }

    /**
     * Export data using the appropriate service exporter
     *
     * @param string $format
     * @param array $data
     */
    public function export(string $format, array $data)
    {
        foreach ($this->exporters as $exporter)
        {
            if ($exporter->support($format)) {
                $exporter->export($data);
                return;
            }
        }

        throw new \RuntimeException(sprintf('Unfound exporter for this % format', $format));
    }
}