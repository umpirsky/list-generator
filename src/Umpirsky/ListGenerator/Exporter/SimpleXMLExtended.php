<?php

namespace Umpirsky\ListGenerator\Exporter;

class SimpleXMLExtended extends \SimpleXMLElement
{
    public function addCData($text)
    {
        $node = dom_import_simplexml($this);
        $node->appendChild(
            $node->ownerDocument->createCDATASection($text)
        );
        return $node; // ??
    }
}
