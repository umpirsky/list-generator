<?php

namespace Umpirsky\ListGenerator\Exporter\Format;

use Umpirsky\ListGenerator\Exporter\Exporter;

class Txt extends Exporter
{
    /**
     * {@inheritdoc}
     */
    public function export(array $data): string
    {
        $txt = '';
        foreach ($data as $id => $name) {
            $txt .= sprintf('%s (%s)%s', $name, $id, PHP_EOL);
        }

        return $txt;
    }
}
