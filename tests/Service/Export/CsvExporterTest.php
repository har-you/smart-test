<?php

namespace  App\Service\Export {
    function  fopen ($filename, $mode, $use_include_path = null, $context = null)
    {
        return true;
    }

    function fputcsv ($handle, array $fields, $delimiter = ",", $enclosure = '"', $escape_char = "\\")
    {
        return true;
    }
}

namespace App\Tests\Service\Export {

    use App\Service\Export\CsvExporter;
    use PHPUnit\Framework\TestCase;
    use Psr\Log\LoggerAwareInterface;
    use Psr\Log\LoggerInterface;
    use Symfony\Component\Filesystem\Filesystem;

    class CsvExporterTest extends TestCase
    {
        private $csvExporter;
        /** @var \PHPUnit\Framework\MockObject\MockObject  */
        private $em;
        /** @var \PHPUnit\Framework\MockObject\MockObject  */
        private $filesystem;


        /**
         * {@inheritDoc}
         */
        protected function setUp(): void
        {
            $this->filesystem = $this->createMock(\Symfony\Component\Filesystem\Filesystem::class);
            $logger = $this->createMock(LoggerInterface::class);
            $this->csvExporter = new CsvExporter($logger, $this->filesystem, 'testExportDir');
        }

        /**
         * Test support
         */
        public function testSupport()
        {
            $this->assertFalse($this->csvExporter->support('xml'));
            $this->assertTrue($this->csvExporter->support('csv'));
        }


        /**
         * @param array $data
         */
        public function testExport()
        {
            $data = [
                [
                    'field' => 'title',
                    'newValue' => 'Test New Value',
                    'oldValue' => 'Test OldValue',
                ],
                [
                    'field' => 'title',
                    'newValue' => 'Test New Value',
                    'oldValue' => 'Test OldValue',
                ]
            ];

            $this->filesystem->expects($this->any())->method('mkdir')->willReturn(true);
            $this->filesystem->expects($this->any())->method('exists')->willReturn(false);
            $this->filesystem->expects($this->any())->method('dumpFile')->willReturn(true);

            $this->assertNull($this->csvExporter->export($data));
        }
    }
}


