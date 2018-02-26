<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\AttachableValue;
use function JsonApiPhp\JsonApi\child;

/**
 * @internal
 */
class AttachableLink extends AttachableValue
{
    public function __construct(string $key, Link $link)
    {
        parent::__construct($key, $link);
    }

    public function attachTo(object $o)
    {
        parent::attachTo(child($o, 'links'));
    }
}
