<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Error\ErrorMember;

final class Error implements ErrorDocumentMember
{
    private $error;

    public function __construct(ErrorMember ...$members)
    {
        $this->error = combine(...$members);
    }

    public function attachTo(object $o)
    {
        $o->errors[] = $this->error;
    }
}
