<?php

namespace Umpirsky\ListGenerator\Importer;

interface ImporterInterface
{
    /**
     * Get available languages.
     *
     * @return string[]
     */
    public function getLanguages();

    /**
     * Get data in given language.
     *
     * @param  string   $language
     * @return string[]
     */
    public function getData($language);

    /**
     * Gets source name.
     *
     * @return string
     */
    public function getSource(): string;
}
