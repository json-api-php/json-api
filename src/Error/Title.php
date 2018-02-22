<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

use JsonApiPhp\JsonApi\Document\JsonSerializableValue;

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

    public function attachTo(object $o): void
    {
        $o->title = $this;
    }
}