<?php

namespace Umpirsky\ListGenerator;

use Umpirsky\ListGenerator\Importer\Importer;
use Umpirsky\ListGenerator\Importer\ImporterInterface;

class ImporterInstance extends Importer
{
    public function getLanguages()
    {
        return ['en'];
    }

    public function getData($language)
    {
        if($language === 'en') {
            return ['imported_value1', 'imported_value2'];
        }
    }

    public function getSource()
    {
        return strtolower(get_class($this));
    }
}
