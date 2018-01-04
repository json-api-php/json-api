<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Error;

use JsonApiPhp\JsonApi\Document\Error\Source\SourceMember;
use JsonApiPhp\JsonApi\Document\JsonSerializableValue;
use JsonApiPhp\JsonApi\Document\Member;
use function JsonApiPhp\JsonApi\mergeAll;

class Title
    extends JsonSerializableValue
    implements ErrorMember
{
    /**
     * @param string $title a short, human-readable summary of the problem that SHOULD NOT change from occurrence
     *                      to occurrence of the problem, except for purposes of localization
     */
    public function __construct(string $title)
    {
        parent::__construct($title);
    }

    final public function toName(): string
    {
        return 'title';
    }
}