<?php

declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\Collection;
use JsonApiPhp\JsonApi\Internal\PrimaryData;

final class PaginatedCollection implements PrimaryData {
    public function __construct(private readonly Pagination $pagination, private readonly Collection $collection) {
    }

    /**
     * @param object $o
     * @internal
     */
    public function attachTo(object $o): void {
        $this->collection->attachTo($o);
        $this->pagination->attachTo($o);
    }
}
