<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\ErrorDocumentMember;
use JsonApiPhp\JsonApi\Internal\ErrorMember;

final class Error implements ErrorDocumentMember
{
    private $error;

    public function __construct(ErrorMember ...$members)
    {
        $this->error = (object) [];
        foreach ($members as $member) {
            $member->attachTo($this->error);
        }
    }

    public function attachTo(object $o)
    {
        $o->errors[] = $this->error;
    }
}
