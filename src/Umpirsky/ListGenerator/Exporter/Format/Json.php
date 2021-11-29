<?php

namespace Umpirsky\ListGenerator\Exporter\Format;

use Umpirsky\ListGenerator\Exporter\Exporter;

class Json extends Exporter
{
    /**
     * {@inheritdoc}
     */
    public function export(array $data): string
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
