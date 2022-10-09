<?php

namespace ProductTrap\Traits;

use Illuminate\Contracts\Cache\Repository as CacheRepository;

trait DriverCache
{
    protected CacheRepository $cache;

    public function has(string $name): bool
    {
        return $this->cache->has($this->getCacheKey($name));
    }

    public function get(string $name)
    {
        return $this->cache->get($this->getCacheKey($name));
    }

    public function set(string $name, $value, $ttl): void
    {
        $this->cache->set($this->getCacheKey($name), $value, $ttl);
    }

    public function unset(string $name): void
    {
        $this->cache->set($this->getCacheKey($name), null);
    }

    public function remember(string $name, $ttl, callable $callback)
    {
        if ($this->has($name)) {
            return $this->get($name);
        }

        $value = $callback();

        $this->set($name, $value, $ttl);

        return $value;
    }

    public function getCacheKey(string $name): string
    {
        return 'producttrap.' . $this->getName() . '.' . $name;
    }
}
