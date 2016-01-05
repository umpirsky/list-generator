<?php

namespace Umpirsky\ListGenerator\Exporter;

interface ExporterInterface
{
    /**
     * Exports data into specific format.
     *
     * @param  array  $data
     * @return string
     */
    public function export(array $data);
}
