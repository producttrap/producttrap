<?php

namespace ProductTrap;

use Symfony\Component\DomCrawler\Crawler;

class Spider
{
    public static array $hashCache = [];

    public static function scrape(string $url, array $options = []): string
    {
        $config = array_replace([
            'binary' => '/snap/bin/chromium',
            'user_agent' => 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:107.0) Gecko/20100101 Firefox/106.0',
        ], $options);

        // $url = 'https://woolworths.com.au/shop/productdetails/257360/john-west-tuna-olive-oil-blend';
        $output = tempnam(sys_get_temp_dir(), 'producttrap');

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

        $html = file_get_contents($output);
        unlink($output);

        return $html;
    }

    public static function crawl(string $url): Crawler
    {
        $html = static::scrape($url);

        return new Crawler($html);
    }
}
