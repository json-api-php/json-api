<?php declare(strict_types=1);
require_once __DIR__.'/../vendor/autoload.php';

use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\RelatedLink;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Link\Url;
use JsonApiPhp\JsonApi\Relationship;
use JsonApiPhp\JsonApi\ResourceIdentifier;
use JsonApiPhp\JsonApi\ResourceObject;
use JsonApiPhp\JsonApi\SingleLinkage;

echo json_encode(
    new DataDocument(
        new ResourceObject(
            'articles',
            '1',
            new Attribute('title', 'Rails is Omakase'),
            new Relationship(
                'author',
                new SingleLinkage(new ResourceIdentifier('author', '9')),
                new SelfLink(new Url('/articles/1/relationships/author')),
                new RelatedLink(new Url('/articles/1/author'))
            )
        )
    ),
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
);
