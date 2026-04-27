<?php

namespace Brdd\Core\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Rule {
    public function __construct(public string $id, public string $message = "") {}
}
