<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\BaseResource;
use JsonApiPhp\JsonApi\Internal\PrimaryData;
use JsonApiPhp\JsonApi\Internal\ResourceMember;

/**
 * A resource to-be-created on the server. Does not have the `id` yet.
 *
 * Class NewResourceObject
 */
final class NewResourceObject extends BaseResource implements PrimaryData
{
    public function __construct(string $type, ResourceMember ...$members)
    {
        parent::__construct($type, ...$members);
    }
}
