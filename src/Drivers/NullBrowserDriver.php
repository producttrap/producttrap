<?php

namespace ProductTrap\Drivers;

use ProductTrap\Contracts\BrowserDriver;
use ProductTrap\DTOs\ScrapeResult;

class NullBrowserDriver implements BrowserDriver
{
    public function __construct(private array $config = [])
    {
    }

    public function getName(): string
    {
        return 'Null browser';
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function setConfig(array $config): self
    {
        $this->config = array_replace($this->config, $config);

        return $this;
    }

    public function crawl(string $url, array $parameters = []): ScrapeResult
    {
        return new ScrapeResult(
            result: 'Null HTML result',
            data: [
                'this is a null browser result',
            ],
        );
    }
}
