<?php

namespace ProductTrap\Contracts;

use ProductTrap\DTOs\CrawlResult;

interface RequiresBrowser
{
    public function setBrowser(BrowserDriver $browser): self;

    public function crawl(): CrawlResult;
}
