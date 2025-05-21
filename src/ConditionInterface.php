<?php

namespace RuleEngine;

interface ConditionInterface
{
    public function evaluate(Context $context): bool;
}
