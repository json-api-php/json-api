<?php declare(strict_types=1);
require_once __DIR__.'/../vendor/autoload.php';

use JsonApiPhp\JsonApi\Attribute;
use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\RelatedLink;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\ResourceIdentifier;
use JsonApiPhp\JsonApi\ResourceObject;
use JsonApiPhp\JsonApi\ToOne;

echo json_encode(
    new DataDocument(
        new ResourceObject(
            'articles',
            '1',
            new Attribute('title', 'Rails is Omakase'),
            new ToOne(
                'author',
                new ResourceIdentifier('author', '9'),
                new SelfLink('/articles/1/relationships/author'),
                new RelatedLink('/articles/1/author')
            )
        )
    ),
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
);
