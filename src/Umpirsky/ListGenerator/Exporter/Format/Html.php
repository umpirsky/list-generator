<?php

namespace Umpirsky\ListGenerator\Exporter\Format;

use Umpirsky\ListGenerator\Exporter\HtmlExporter;

class Html extends HtmlExporter
{
    /**
     * {@inheritdoc}
     */
    public function export(array $data): string
    {
        $selectElement = $this->getDocument()->createElement('select');
        $selectElement->setAttribute('name', 'value');
        foreach ($data as $id => $name) {
            $optionElement = $this->getDocument()->createElement(
                'option',
                htmlentities($name)
            );
            $optionElement->setAttribute('value', $id);
            $selectElement->appendChild($optionElement);
        }

        return $this->exportHtml($selectElement);
    }
}
