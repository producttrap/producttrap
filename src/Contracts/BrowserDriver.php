<?php

namespace ProductTrap\Contracts;

use ProductTrap\DTOs\CrawlResult;

interface BrowserDriver
{
    public function getName(): string;

    public function getConfig(): array;

    public function setConfig(array $config): self;

    public function crawl(string $url, array $parameters): CrawlResult;
}
