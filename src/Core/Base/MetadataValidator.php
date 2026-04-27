<?php

namespace Brdd\Core\Base;

use Brdd\Core\Attributes\Rule;
use ReflectionClass;

abstract class MetadataValidator {
    public function validateAll($context, $data): void {
        $reflection = new ReflectionClass($this);
        foreach ($reflection->getMethods() as $method) {
            $attributes = $method->getAttributes(Rule::class);
            foreach ($attributes as $attribute) {
                $rule = $attribute->newInstance();
                $result = $method->invoke($this, $data);
                
                if (is_bool($result) && !$result) {
                    $context->addError($rule->id, $rule->message);
                }
            }
        }
    }
}
