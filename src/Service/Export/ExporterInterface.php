<?php

namespace App\Service\Export;

/**
 * Interface ExporterInterface
 */
interface ExporterInterface
{

    /**
     * export data with the format supported
     *
     * @param array $data Data to be exported
     */
    public function export(array $data): void;

    /**
     * check if exporter support the format passed by parameter
     *
     * @param string $format
     * @return bool
     */
    public function support(string $format): bool ;
}