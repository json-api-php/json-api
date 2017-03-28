<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

trait HasLinks
{
    public function setLink(string $name, string $value, array $meta = null): void
    {
        $this->links[$name] = $meta ? ['href' => $value, 'meta' => $meta] : $value;
    }
}
