<?php

namespace ProductTrap\Contracts;

use ProductTrap\DTOs\Query;
use ProductTrap\DTOs\Results;

interface SupportsSearches
{
    /**
     * @param  array<string, mixed>  $parameters
     */
    public function search(Query $query, array $parameters = []): Results;
}
