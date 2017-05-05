<?php
/**
 *  This file is part of JSON:API implementation for PHP.
 *
 *  (c) Alexey Karapetov <karapetov@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
declare(strict_types=1);

namespace JsonApiPhp\JsonApi\Document\Resource\Relationship;

use JsonApiPhp\JsonApi\Document\Resource\ResourceIdentifier;
use JsonApiPhp\JsonApi\Document\Resource\ResourceInterface;

final class Linkage implements \JsonSerializable
{
    private $data;

    private function __construct()
    {
    }

    public static function nullLinkage(): self
    {
        return new self;
    }

    public static function emptyArrayLinkage(): self
    {
        $linkage = new self;
        $linkage->data = [];
        return $linkage;
    }

    public static function fromSingleIdentifier(ResourceIdentifier $data): self
    {
        $linkage = new self;
        $linkage->data = $data;
        return $linkage;
    }

    public static function fromManyIdentifiers(ResourceIdentifier ...$data): self
    {
        $linkage = new self;
        $linkage->data = $data;
        return $linkage;
    }

    public function isLinkedTo(ResourceInterface $resource): bool
    {
        foreach ($this->toLinkages() as $linkage) {
            if ($linkage->identifies($resource)) {
                return true;
            }
        }
        return false;
    }

    private function toLinkages(): \Generator
    {
        if ($this->data instanceof ResourceIdentifier) {
            yield $this->data;
        } elseif (is_array($this->data)) {
            foreach ($this->data as $resource) {
                yield $resource;
            }
        }
    }

    public function jsonSerialize()
    {
        return $this->data;
    }
}
