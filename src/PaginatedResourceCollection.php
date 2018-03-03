<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

final class PaginatedResourceCollection extends ResourceCollection
{
    /**
     * @var Pagination
     */
    private $pagination;

    public function __construct(Pagination $pagination, ResourceObject ...$resources)
    {
        parent::__construct(...$resources);
        $this->pagination = $pagination;
    }

    public function attachTo(object $o): void
    {
        parent::attachTo($o);
        $this->pagination->attachTo($o);
    }
}
