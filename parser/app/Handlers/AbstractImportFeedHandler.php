<?php

namespace App\Handlers;

use App\Parsers\Xml\XmlParserInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\File\File;
use Generator;

abstract class AbstractImportFeedHandler extends AbstractImportHandler
{
    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    protected function getIterator(File $file): Generator
    {
        $rootNode = $this->getXmlParser();
        $rootNode->addXmlContent($file->getContent());

        $nodeList = $rootNode->filter($this->getRootNodeFilter())->getIterator();

        foreach ($nodeList as $node) {
            yield new Crawler($node);
        }
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getXmlParser(): XmlParserInterface
    {
        return $this->container->get(XmlParserInterface::class);
    }

    protected function getRootNodeFilter(): string
    {
        return static::ROOT_NODE_FILTER;
    }

    public static function getSubscribedServices(): array
    {
        return
            [
                XmlParserInterface::class
            ];
    }
}
