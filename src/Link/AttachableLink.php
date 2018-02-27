<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Attachable;
use function JsonApiPhp\JsonApi\child;

/**
 * @internal
 */
class AttachableLink implements Attachable
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var Link
     */
    private $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public function attachTo(object $o)
    {
        child($o, 'links')->{$this->key} = $this->link;
    }
}
