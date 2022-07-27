<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Link;

use JsonApiPhp\JsonApi\Internal\DataDocumentMember;
use JsonApiPhp\JsonApi\Internal\LinkTrait;
use JsonApiPhp\JsonApi\Internal\RelationshipMember;

use function JsonApiPhp\JsonApi\child;

final class RelatedLink implements RelationshipMember, DataDocumentMember {
    use LinkTrait;

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        child($o, 'links')->related = $this->link;
    }
}
