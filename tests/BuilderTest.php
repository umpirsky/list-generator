<?php

namespace Umpirsky\ListGenerator;

use Umpirsky\ListGenerator\Builder\Builder;
use Symfony\Component\Console\Command\Command;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    /**
     * @var Builder
     */
    private $builder;

    protected function setUp(): void
    {
        $this->builder = new Builder(new ImporterInstance(), 'importer_path');
    }

    public function testBuildCommandExists()
    {
        $this->assertTrue($this->builder->has('build'));
        $this->assertInstanceOf(Command::class, $this->builder->get('build'));
    }
}
