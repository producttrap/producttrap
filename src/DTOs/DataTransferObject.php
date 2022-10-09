<?php

declare(strict_types=1);

namespace ProductTrap\DTOs;

use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject as BaseDataTransferObject;

#[Strict]
class DataTransferObject extends BaseDataTransferObject
{
    public function toArray(): array
    {
        $data = parent::toArray();
        unset($data['raw']);

        return $data;
    }
}
