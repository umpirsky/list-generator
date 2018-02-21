<?php

namespace Umpirsky\ListGenerator;

use Umpirsky\ListGenerator\Builder\Builder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;
use PHPUnit\Framework\TestCase;

class BuildCommandTest extends TestCase
{
    /**
     * @var commandTester
     */
    private $commandTester;

    /**
     * @var vfsStreamDirectory
     */
    private $vfsDirectory;

    protected function setUp()
    {
        $builder = new Builder(new ImporterInstance(), 'importer_path');
        $command = $builder->get('build');

        $this->commandTester = new CommandTester($command);
    }

    protected function tearDown()
    {
        $format = ['json', 'csv', 'html', 'txt', 'xliff', 'xml', 'yaml', 'php'];
        foreach($format as $formatName) {
            $importerFile = glob(__DIR__.'/../importer_path/en/*.'.$formatName);
            foreach($importerFile as $file) {
                @unlink($file);
            }
        }

        @rmdir(__DIR__.'/../importer_path/en');
        @rmdir(__DIR__.'/../importer_path');
    }

    public function testBuildCommandWithFormatJson()
    {
        $this->commandTester->execute([
            'language' => 'en',
            'format' => 'json'
        ]);

        $this->assertSame(0, $this->commandTester->getStatusCode());
        $this->assertContains('', $this->commandTester->getDisplay());
    }

    public function testBuildCommandWithFormatCsv()
    {
        $this->commandTester->execute([
            'language' => 'en',
            'format' => 'csv'
        ]);

        $this->assertSame(0, $this->commandTester->getStatusCode());
        $this->assertContains('', $this->commandTester->getDisplay());
    }

    public function testBuildCommandWithFormatHtml()
    {
        $this->commandTester->execute([
            'language' => 'en',
            'format' => 'html'
        ]);

        $this->assertSame(0, $this->commandTester->getStatusCode());
        $this->assertContains('', $this->commandTester->getDisplay());
    }

    public function testBuildCommandWithFormatPhp()
    {
        $this->commandTester->execute([
            'language' => 'en',
            'format' => 'php'
        ]);

        $this->assertSame(0, $this->commandTester->getStatusCode());
        $this->assertContains('', $this->commandTester->getDisplay());
    }

    public function testBuildCommandWithFormatTxt()
    {
        $this->commandTester->execute([
            'language' => 'en',
            'format' => 'txt'
        ]);

        $this->assertSame(0, $this->commandTester->getStatusCode());
        $this->assertContains('', $this->commandTester->getDisplay());
    }

    public function testBuildCommandWithFormatXliff()
    {
        $this->commandTester->execute([
            'language' => 'en',
            'format' => 'xliff'
        ]);

        $this->assertSame(0, $this->commandTester->getStatusCode());
        $this->assertContains('', $this->commandTester->getDisplay());
    }

    public function testBuildCommandWithFormatXml()
    {
        $this->commandTester->execute([
            'language' => 'en',
            'format' => 'xml'
        ]);

        $this->assertSame(0, $this->commandTester->getStatusCode());
        $this->assertContains('', $this->commandTester->getDisplay());
    }

    public function testBuildCommandWithFormatYaml()
    {
        $this->commandTester->execute([
            'language' => 'en',
            'format' => 'yaml'
        ]);

        $this->assertSame(0, $this->commandTester->getStatusCode());
        $this->assertContains('', $this->commandTester->getDisplay());
    }
}