<?php

namespace RuleEngine;

class Rule
{
    public function __construct(
        private ConditionInterface $condition,
        private ActionInterface $action
    ) {}

    public function apply(Context $context): void
    {
        if ($this->condition->evaluate($context)) {
            $this->action->execute($context);
        }
    }
}
