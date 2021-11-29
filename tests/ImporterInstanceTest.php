<?php

namespace Umpirsky\ListGenerator;

use PHPUnit\Framework\TestCase;
use Umpirsky\ListGenerator\Importer\Importer;
use Umpirsky\ListGenerator\Importer\ImporterInterface;

class ImporterInstanceTest extends TestCase
{
    public function testGetSource()
    {
        $importer = new ImporterInstance();

        $this->assertSame('umpirsky\listgenerator\importerinstance', $importer->getSource());
    }
}
