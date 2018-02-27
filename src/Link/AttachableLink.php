<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Attachable;
use function JsonApiPhp\JsonApi\child;

/**
 * @internal
 */
class AttachableLink implements Attachable, \JsonSerializable
{
    /**
     * @var string
     */
    private $key;
    /**
     * @var Link
     */
    private $link;

    public function __construct(string $key, Link $link)
    {
        $this->key = $key;
        $this->link = $link;
    }

    public function attachTo(object $o)
    {
        child($o, 'links')->{$this->key} = $this;
    }

    public function jsonSerialize()
    {
        return $this->link;
    }
}
