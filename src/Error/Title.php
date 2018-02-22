<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Error;

class Title
    implements ErrorMember
{
    /**
     * @var string
     */
    private $title;

    /**
     * @param string $title a short, human-readable summary of the problem that SHOULD NOT change from occurrence
     *                      to occurrence of the problem, except for purposes of localization
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    final public function name(): string
    {
        return 'title';
    }

    public function jsonSerialize(): string
    {
        return $this->title;
    }
}