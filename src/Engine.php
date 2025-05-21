<?php

namespace RuleEngine;

class Engine
{
    /** @var Rule[] */
    private array $rules = [];

    public function addRule(Rule $rule): void
    {
        $this->rules[] = $rule;
    }

    public function run(Context $context): void
    {
        foreach ($this->rules as $rule) {
            $rule->apply($context);
        }
    }
}
