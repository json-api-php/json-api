<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Document\AttachableValue;
use JsonApiPhp\JsonApi\ErrorDocumentMember;

final class Errors
    extends AttachableValue
    implements ErrorDocumentMember
{
    public function __construct(Error $error, Error ...$errors)
    {
        parent::__construct('errors', func_get_args());
    }
}