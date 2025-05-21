<?php

namespace RuleEngine\Tests;

use PHPUnit\Framework\TestCase;
use RuleEngine\Engine;

final class EngineTest extends TestCase
{
    public function testValidateAnyReturnsTrueIfOneRuleMatches(): void
    {
        $engine = new Engine();

        $engine->addRule(fn($fact) => false);
        $engine->addRule(fn($fact) => $fact === 42); // this one matches

        $this->assertTrue($engine->validateAny(42));
    }

    public function testValidateAnyReturnsFalseIfNoRuleMatches(): void
    {
        $engine = new Engine();

        $engine->addRule(fn($fact) => false);
        $engine->addRule(fn($fact) => $fact === 'wrong');

        $this->assertFalse($engine->validateAny(123));
    }

    public function testValidateAllReturnsTrueIfAllRulesMatch(): void
    {
        $engine = new Engine();

        $engine->addRule(fn($fact) => is_int($fact));
        $engine->addRule(fn($fact) => $fact > 10);

        $this->assertTrue($engine->validateAll(42));
    }

    public function testValidateAllReturnsFalseIfOneRuleFails(): void
    {
        $engine = new Engine();

        $engine->addRule(fn($fact) => is_int($fact));
        $engine->addRule(fn($fact) => $fact > 1000); // fails

        $this->assertFalse($engine->validateAll(50));
    }
}
