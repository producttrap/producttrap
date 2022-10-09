<?php

namespace ProductTrap;

use Exception;
use ProductTrap\Contracts\Driver;
use ProductTrap\Exceptions\ApiConnectionFailedException;
use Symfony\Component\DomCrawler\Crawler;

class Spider
{
    public static array $hashCache = [];

    public function __construct(protected readonly Driver $driver)
    {
    }

    public function scrape(string $url, array $options = []): string
    {
        $config = array_replace([
            'binary' => '/snap/bin/chromium',
            'user_agent' => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:107.0) Gecko/20100101 Firefox/106.0',
        ], $options);

        $output = tempnam(sys_get_temp_dir(), 'producttrap');

        if ($output === false) {
            throw new Exception('Could not create temporary file for crawler output file.');
        }

        $cmd = vsprintf(
            '%s --headless --dump-dom --user-agent="%s" --wait-until="networkidle2" %s %s > %s',
            [
                $config['binary'],
                $config['user_agent'],
                $config['options'] ?? '',
                $url,
                $output,
            ],
        );

        exec($cmd);

        if (! file_exists($output) || empty(filesize($output))) {
            throw new ApiConnectionFailedException(
                driver: $this->driver,
                resourceOrUrl: $url
            );
        }

        $html = file_get_contents($output);
        unlink($output);

        return (string) $html;
    }

    public function crawl(string $url): Crawler
    {
        $html = $this->scrape($url);

        return new Crawler($html);
    }
}
