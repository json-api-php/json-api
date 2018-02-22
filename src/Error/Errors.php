<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\ErrorDocumentMember;

final class Errors
    extends JsonSerializableValue
    implements ErrorDocumentMember
{
    public function __construct(Error $error, Error ...$errors)
    {
        parent::__construct(func_get_args());
    }

    public function attachTo(object $o): void
    {
        $o->errors = $this;
    }
}