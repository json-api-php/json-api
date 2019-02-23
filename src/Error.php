<?php declare(strict_types=1);

namespace JsonApiPhp\JsonApi;

use JsonApiPhp\JsonApi\Internal\ErrorDocumentMember;
use JsonApiPhp\JsonApi\Internal\ErrorMember;

/**
 * An Error Object
 * @see
 */
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

    /**
     * @param object $o
     */
    public function attachTo($o): void
    {
        $o->errors[] = $this->error;
    }
}
