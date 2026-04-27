<?php

declare(strict_types=1);

namespace Brdd\Tests\Contexts;

use PHPUnit\Framework\TestCase;
use Brdd\Contexts\ExecutionContext;
use Brdd\Contexts\ValidationContext;

class ExecutionContextTest extends TestCase
{
    public function testBuildCreatesContextProperly(): void
    {
        $valContext = ValidationContext::build();
        $ctx = ExecutionContext::build('US001', $valContext);

        $this->assertSame('US001', $ctx->getUseCaseCode());
        $this->assertFalse($ctx->hasErrors());
        $this->assertNull($ctx->getData());
    }

    public function testSettersAreRegistered(): void
    {
        $valContext = ValidationContext::build();
        $ctx = ExecutionContext::build('US001', $valContext);

        $ctx->addSetter('SET_NAME', 'Leo');
        $ctx->addSetter('SET_AGE', 30);

        $this->assertCount(2, $ctx->getSetters());
        $this->assertSame('Leo', $ctx->getSetters()['SET_NAME']);
        $this->assertSame(30, $ctx->getSetters()['SET_AGE']);
    }

    public function testEffectsAreRegistered(): void
    {
        $valContext = ValidationContext::build();
        $ctx = ExecutionContext::build('US001', $valContext);

        $callable = function() { return true; };
        $ctx->addEffect(ExecutionContext::POST_EFFECT, 'EFF_NOTIFY', $callable);

        $this->assertCount(1, $ctx->getEffects());
        $effect = $ctx->getEffects()[0];
        
        $this->assertSame(ExecutionContext::POST_EFFECT, $effect['type']);
        $this->assertSame('EFF_NOTIFY', $effect['code']);
        $this->assertSame($callable, $effect['callable']);
    }

    public function testDataHandling(): void
    {
        $valContext = ValidationContext::build();
        $ctx = ExecutionContext::build('US001', $valContext);

        $ctx->setData(['id' => 123]);
        $this->assertSame(['id' => 123], $ctx->getData());
    }
}
