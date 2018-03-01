<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\PrimaryData;

/**
 * @internal
 */
trait IdentityTrait
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @internal
     * @return string
     */
    public function identity(): string
    {
        return "{$this->type}:{$this->id}";
    }
}
