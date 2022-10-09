<?php

namespace ProductTrap\Traits;

use ProductTrap\Contracts\Driver;
use ProductTrap\Spider;
use Symfony\Component\DomCrawler\Crawler;

trait DriverCrawler
{
    public function spider(): Spider
    {
        /** @var Driver $this */
        return new Spider(driver: $this);
    }

    public function scrape(string $url): string
    {
        return $this->spider()->scrape($url);
    }

    public function crawl(string $html): Crawler
    {
        return new Crawler($html);
    }
}
