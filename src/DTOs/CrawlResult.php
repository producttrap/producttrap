<?php

namespace ProductTrap\DTOs;

class CrawlResult extends DataTransferObject
{
    public ?string $result;

    public array $data = [];
}
