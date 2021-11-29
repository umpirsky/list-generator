<?php

namespace Umpirsky\ListGenerator;

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

    public function getSource(): string
    {
        return strtolower(get_class($this));
    }
}
