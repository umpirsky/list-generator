<?php

namespace Umpirsky\ListGenerator;

use Umpirsky\ListGenerator\Builder\Builder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;
use Umpirsky\ListGenerator\Exporter\Iterator as ExportIterator;
use PHPUnit\Framework\TestCase;

class BuildCommandTest extends TestCase
{
    /**
     * @var CommandTester
     */
    private $commandTester;

    /**
     * @var ExportIterator
     */
    private $exportIterator;

    protected function setUp()
    {
        $builder = new Builder(new ImporterInstance(), 'importer_path');
        $command = $builder->get('build');

        $this->commandTester = new CommandTester($command);
    }

    protected function tearDown()
    {
        $this->exportIterator = new ExportIterator();
        foreach ($this->exportIterator as $exporter) {
            $importerFile = glob(__DIR__.'/../importer_path/en/*.'.$exporter->getFormat());
            foreach($importerFile as $file) {
                file_exists($file) ? unlink($file) : false;
            }
        }

        rmdir(__DIR__.'/../importer_path/en');
        rmdir(__DIR__.'/../importer_path');
    }

    /**
     * @dataProvider argumentDataProvider
     */
    public function testBuildCommand($language, $format)
    {
        $this->commandTester->execute([
            'language' => $language,
            'format' => $format,
        ]);

        $this->assertSame(0, $this->commandTester->getStatusCode());
        $this->assertEmpty($this->commandTester->getDisplay());
    }

    public function argumentDataProvider()
    {
        return [
            ['en', 'json'],
            ['en', 'csv'],
            ['en', 'html'],
            ['en', 'php'],
            ['en', 'txt'],
            ['en', 'xliff'],
            ['en', 'xml'],
            ['en', 'yaml'],
        ];
    }
}