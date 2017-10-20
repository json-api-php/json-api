<?php
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document;

class Meta implements \JsonSerializable
{
    /**
     * @var Container
     */
    private $data;

    public function __construct(\stdClass $data)
    {
        $this->data = $this->toContainer($data);
    }

    public static function fromArray(array $array): self
    {
        return new self((object) $array);
    }

    public function jsonSerialize()
    {
        return $this->data;
    }

    private function toContainer($object): Container
    {
        $c = new Container();
        foreach ($object as $name => $value) {
            if (is_object($object)) {
                $name = (string) $name;
            }
            if ($this->canConvert($value)) {
                $value = $this->toContainer($value);
            } else {
                $value = $this->traverse($value);
            }
            $c->set(new MemberName($name), $value);
        }
        return $c;
    }

    private function traverse($value)
    {
        if ($this->canConvert($value)) {
            return $this->toContainer($value);
        }
        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $value[$k] = $this->traverse($v);
            }
        }
        return $value;
    }

    private function canConvert($v): bool
    {
        return is_object($v)
            || (
                is_array($v)
                && $v !== []
                && array_keys($v) !== range(0, count($v) - 1)
            );
    }
}
