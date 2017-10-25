<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

use function JsonApiPhp\JsonApi\isValidMemberName;

final class Container implements \JsonSerializable
{
    private $data;

    public function __construct(iterable $data = null)
    {
        if ($data) {
            foreach ($data as $k => $v) {
                $this->set((string) $k, $v);
            }
        }
    }

    public function set(string $name, $value)
    {
        if (! isValidMemberName($name)) {
            throw new \OutOfBoundsException("Invalid member name '$name'");
        }
        $this->data[$name] = $value;
    }

    public function jsonSerialize()
    {
        return (object) $this->data;
    }
}
