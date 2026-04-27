<?php

namespace Brdd\Core\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Effect {
    public function __construct(public string $id) {}
}
