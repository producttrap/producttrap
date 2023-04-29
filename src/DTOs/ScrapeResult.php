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

    public function serialize(): string
    {
        return (string) json_encode([
            'result' => $this->result,
            'data' => $this->data,
        ]);
    }

    public function unserialize(string $data)
    {
        $data = (array) json_decode($data, true);

        $this->result = is_string($data['result']) ? $data['result'] : null;
        $this->data = is_array($data['data']) ? $data['data'] : [];
    }
}
