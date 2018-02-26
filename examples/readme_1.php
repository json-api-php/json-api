<?php
require_once __DIR__ . '/../vendor/autoload.php';

use JsonApiPhp\JsonApi\DataDocument;
use JsonApiPhp\JsonApi\Link\RelatedLink;
use JsonApiPhp\JsonApi\Link\SelfLink;
use JsonApiPhp\JsonApi\Link\Url;
use JsonApiPhp\JsonApi\PrimaryData\Attribute;
use JsonApiPhp\JsonApi\PrimaryData\ResourceIdentifier;
use JsonApiPhp\JsonApi\PrimaryData\ResourceObject;
use JsonApiPhp\JsonApi\Relationship;
use JsonApiPhp\JsonApi\SingleLinkage;


echo json_encode(
    new DataDocument(
        new ResourceObject('articles', '1',
            new Attribute('title', 'Rails is Omakase'),
            new Relationship('author',
                new SingleLinkage(new ResourceIdentifier('author', '9')),
                new SelfLink(new Url('/articles/1/relationships/author')),
                new RelatedLink(new Url('/articles/1/author'))
            )
        )
    ),
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
);