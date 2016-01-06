<?php

namespace Umpirsky\ListGenerator\Exporter\Format;

use Umpirsky\ListGenerator\Exporter\Exporter;

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
            $element->addChild('value', $element->addCData($name));
        }

        return $collectionElement->asXML();
    }
}

class SimpleXMLExtended extends \SimpleXMLElement
{
    public function addCData($text)
    {
        $node = dom_import_simplexml($this);
        $node->appendChild(
            $node->ownerDocument->createCDATASection($text)
        );
    }
}
