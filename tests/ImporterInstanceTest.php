<?php

namespace Umpirsky\ListGenerator;

use PHPUnit\Framework\TestCase;
use Umpirsky\ListGenerator\Importer\Importer;
use Umpirsky\ListGenerator\Importer\ImporterInterface;

class ImporterInstance extends Importer
{
    public function getLanguages()
    {
        return ['en', 'zh_TW'];
    }

    public function getData($language)
    {
        if($language === 'en') {
            return ['imported_value1', 'imported_value2'];
        } else {
            return ['值1', '值2'];
        }
    }

    public function getSource()
    {
        return strtolower(get_class($this));
    }
}

class ImporterInstanceTest extends TestCase
{
    public function testGetSource()
    {
        $importer = new ImporterInstance();

        $this->assertSame('umpirsky\listgenerator\importerinstance', $importer->getSource());
    }
}