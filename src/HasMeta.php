<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

trait HasMeta
{
    public function setMeta(string $key, $val): void
    {
        $this->meta[$key] = $val;
    }

    public function replaceMeta(array $meta): void
    {
        $this->meta = null;
        foreach ($meta as $key => $value) {
            $this->setMeta($key, $value);
        }
    }
}
