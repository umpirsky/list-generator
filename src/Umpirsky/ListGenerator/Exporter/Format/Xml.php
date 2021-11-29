<?php

namespace Umpirsky\ListGenerator\Exporter\Format;

use Umpirsky\ListGenerator\Exporter\Exporter;
use Umpirsky\ListGenerator\Exporter\SimpleXMLExtended;

class Xml extends Exporter
{
    /**
     * {@inheritdoc}
     */
    public function export(array $data)
    {
        $collectionElement = new SimpleXMLExtended("<?xml version=\"1.0\" encoding=\"utf-8\"?><values/>");

        foreach ($data as $iso => $name) {
            $element = $collectionElement->addChild('item');
            $element->addChild('id', $iso);
            $element->addCData($name);
        }

        return $collectionElement->asXML();
    }
}

