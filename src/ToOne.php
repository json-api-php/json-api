<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\PrimaryData\Identifier;
use JsonApiPhp\JsonApi\PrimaryData\ResourceField;
use JsonApiPhp\JsonApi\ResourceObject\IdentifierRegistry;

final class ToOne extends ResourceField implements Identifier
{
    /**
     * @var ResourceIdentifier
     */
    private $identifier;

    private $val;

    public function __construct(string $name, ResourceIdentifier $identifier, ToOneMember ...$members)
    {
        parent::__construct($name);
        $this->val = combine($identifier, ...$members);
        $this->identifier = $identifier;
    }

    public function attachTo(object $o)
    {
        child($o, 'relationships')->{$this->name} = $this->val;
    }

    public function identifies(ResourceObject $resource): bool
    {
        return $this->identifier->identifies($resource);
    }

    public function registerIdentifier(IdentifierRegistry $registry)
    {
        $registry->register($this->identifier);
    }
}
