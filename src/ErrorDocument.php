<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\Error\Errors;

class ErrorDocument
    extends JsonSerializableValue
{
    /**
     * @param \JsonApiPhp\JsonApi\Error\Error[] $errors
     * @param \JsonApiPhp\JsonApi\TopLevelDocumentMember[] ...$members
     */
    public function __construct(array $errors, TopLevelDocumentMember ...$members)
    {
        parent::__construct(combine(new Errors(...$errors), ...$members));
    }
}