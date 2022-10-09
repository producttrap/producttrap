<?php

namespace ProductTrap\Traits;

use ProductTrap\Spider;
use Symfony\Component\DomCrawler\Crawler;

trait DriverCrawler
{
    public function scrape(string $url): string
    {
        return Spider::scrape($url);
    }

    public function crawl(string $html): Crawler
    {
        return new Crawler($html);
    }
}
