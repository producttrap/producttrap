<?php

namespace ProductTrap\DTOs;

use Serializable;

class ScrapeResult extends DataTransferObject implements Serializable
{
    public ?string $result;

    public array $data = [];

    public function __toString(): string
    {
        return (string) $this->result;
    }

    public function serialize()
    {
        return json_encode([
            'result' => $this->result,
            'data' => $this->data,
        ]);
    }

    public function unserialize(string $data)
    {
        $data = json_decode($data, true);

        $this->result = $data['result'];
        $this->data = $data['data'];
    }
}
