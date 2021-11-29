<?php

namespace Umpirsky\ListGenerator\Exporter\Format;

use Umpirsky\ListGenerator\Exporter\Exporter;

/**
 * XLIFF exporter.
 *
 * @author Fabien Warniez <fabien@warniez.com>
 */
class Xliff extends Exporter
{
    const KEY_FORMAT = 'country.%s';

    /**
     * {@inheritdoc}
     */
    public function export(array $data): string
    {
        $rootElement = new \SimpleXMLElement("<?xml version=\"1.0\"?><xliff version=\"1.2\" xmlns=\"urn:oasis:names:tc:xliff:document:1.2\"/>");
        $fileElement = $rootElement->addChild('file');
        $fileElement->addAttribute('datatype', 'plaintext');
        $fileElement->addAttribute('original', '');
        $fileElement->addAttribute('source-language', 'en');
        $bodyElement = $fileElement->addChild('body');

        foreach ($data as $iso => $name) {
            $element = $bodyElement->addChild('trans-unit');
            $element->addAttribute('id', sprintf(self::KEY_FORMAT, $iso));
            $element->addAttribute('resname', sprintf(self::KEY_FORMAT, $iso));
            $element->addChild('source');
            $element->addChild('target', htmlspecialchars($name));
        }

        return $rootElement->asXML();
    }
}
