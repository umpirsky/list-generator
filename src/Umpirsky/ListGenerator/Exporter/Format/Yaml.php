<?php

namespace Umpirsky\ListGenerator\Exporter\Format;

use Umpirsky\ListGenerator\Exporter\Exporter;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;

class Yaml extends Exporter
{
    /**
     * {@inheritdoc}
     */
    public function export(array $data): string
    {
        return SymfonyYaml::dump($data);
    }
}
