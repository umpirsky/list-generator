<?php

namespace Umpirsky\ListGenerator\Exporter\Format;

use Umpirsky\ListGenerator\Exporter\Exporter;

class Php extends Exporter
{
    /**
     * {@inheritdoc}
     */
    public function export(array $data): string
    {
        return sprintf('<?php return %s;%s', var_export($data, true), PHP_EOL);
    }
}
