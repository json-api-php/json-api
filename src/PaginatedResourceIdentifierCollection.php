<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

class PaginatedResourceIdentifierCollection extends ResourceIdentifierCollection
{
    /**
     * @var Pagination
     */
    private $pagination;

    public function __construct(Pagination $pagination, ResourceIdentifier ...$identifiers)
    {
        parent::__construct(...$identifiers);
        $this->pagination = $pagination;
    }

    public function attachTo(object $o)
    {
        parent::attachTo($o);
        $this->pagination->attachTo($o);
    }
}
