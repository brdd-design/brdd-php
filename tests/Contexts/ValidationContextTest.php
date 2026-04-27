<?php

declare(strict_types=1);

namespace Brdd\Tests\Contexts;

use PHPUnit\Framework\TestCase;
use Brdd\Contexts\ValidationContext;

class ValidationContextTest extends TestCase
{
    public function testBuildCreatesEmptyContext(): void
    {
        $context = ValidationContext::build();
        $this->assertFalse($context->hasErrors());
        $this->assertEmpty($context->getErrors());
    }

    public function testAddErrorRegistersProperly(): void
    {
        $context = ValidationContext::build();
        $context->addError('R001', 'Test Error');

        $this->assertTrue($context->hasErrors());
        $this->assertCount(1, $context->getErrors());
        
        $error = $context->getErrors()[0];
        $this->assertSame('R001', $error->code);
        $this->assertSame('Test Error', $error->message);
    }
}
