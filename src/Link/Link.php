<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Attachable;
use JsonApiPhp\JsonApi\Meta;
use function JsonApiPhp\JsonApi\child;
use function JsonApiPhp\JsonApi\combine;

/**
 * @internal
 */
abstract class Link implements Attachable
{
    protected $name;
    private $link;

    public function __construct(string $url, Meta ...$metas)
    {
        if ($metas) {
            $this->link = combine(...$metas);
            $this->link->href = $url;
        } else {
            $this->link = $url;
        }
    }

    public function attachTo(object $o)
    {
        child($o, 'links')->{$this->name} = $this->link;
    }
}
