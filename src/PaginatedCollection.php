<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\Collection;
use JsonApiPhp\JsonApi\Internal\PrimaryData;

final class PaginatedCollection implements PrimaryData
{
    /**
     * @var Pagination
     */
    private $pagination;
    /**
     * @var Collection
     */
    private $collection;

    public function __construct(Pagination $pagination, Collection $collection)
    {
        $this->pagination = $pagination;
        $this->collection = $collection;
    }

    public function attachTo(object $o): void
    {
        $this->collection->attachTo($o);
        $this->pagination->attachTo($o);
    }

    /**
     * @internal
     * @param array $registry
     */
    public function registerIn(array &$registry): void
    {
        $this->collection->registerIn($registry);
    }
}
