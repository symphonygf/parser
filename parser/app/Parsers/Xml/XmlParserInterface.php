<?php

namespace App\Parsers\Xml;

use ArrayIterator;

interface XmlParserInterface
{
    /** @return void */
    public function addContent(string $content, string $type = null);
    public function filter(string $selector): static;
    public function getIterator(): ArrayIterator;
}
