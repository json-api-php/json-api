<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

trait MetaTrait
{
    protected $meta;

    public function setMeta(Meta $meta)
    {
        $this->meta = $meta;
    }
}
