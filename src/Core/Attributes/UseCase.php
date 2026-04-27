<?php

namespace Brdd\Core\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class UseCase {
    public function __construct(public string $id) {}
}
