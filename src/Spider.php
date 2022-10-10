<?php

namespace ProductTrap;

use Exception;
use ProductTrap\Contracts\Driver;
use ProductTrap\Exceptions\ApiConnectionFailedException;
use Symfony\Component\DomCrawler\Crawler;

class Spider
{
    public static ?array $faked = null;

    public function __construct(protected readonly Driver $driver)
    {
    }

    public static function fake(array $responses = []): void
    {
        static::$faked = $responses;
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

        $options = array_replace([
            'headless',
            'dump-dom',
            'user-agent' => $config['user_agent'],
            'wait-until' => 'networkidle2',
        ], $config['arguments'] ?? []);

        $args = [];
        foreach ($options as $key => $value) {
            $format = is_int($key) ? '--%s' : '--%s=%s';
            $bindings = is_int($key) ? [(string) $value] : [(string) $key, json_encode($value)];

            $args[] = vsprintf($format, $bindings);
        }
        $args = implode(' ', $args);

        $cmd = sprintf(
            '%s %s %s > %s',
            $config['binary'], // chromium
            $args, // --headless --dump-dom --user-agent="..." --wait-until="networkidle2"
            $url, // https://www.woolworths.com.au/shop/productdetails/257360/john-west-tuna-olive-oil-blend
            $output, // /tmp/producttrap/abc123
        );

        if (static::$faked !== null) {
            $html = '';

            if (isset(static::$faked[$url])) {
                $html = static::$faked[$url];

                unset(static::$faked[$url]);
            } elseif (isset(static::$faked['*'])) {
                $html = static::$faked['*'];

                unset(static::$faked['*']);
            }

            file_put_contents($output, $html);
        }

        if (static::$faked === null) {
            exec($cmd);
        }

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
