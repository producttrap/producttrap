<?php

namespace ProductTrap\Contracts;

/**
 * Due to some websites providing a varying number of products per page (e.g. self
 * promoting product adverts, product recommendations, etc), the `perPage` property
 * was deemed irrelevant. Similarly, some websites won't tell you the total number
 * of results and as such the `total` property was deemed irrelevant.
 *
 * The bare minimum that a paginated driver needs to support is the current page
 * property and the last page property. If no last page is available, the driver
 * should return the current page + 1 until the driver returns no results.
 *
 * Usage:
 *
 *    $results = new Results(query: $query);
 *    $page = 0;
 *
 *    while ($page < $driver->getLastPage()) {
 *        $results->merge(
 *            $driver->page($page++)->search($query, []),
 *        );
 *    }
 */
interface SupportsPagination
{
    public function page(int $page): self;

    public function getPage(): int;

    public function lastPage(int $page): self;

    public function getLastPage(): int;
}
