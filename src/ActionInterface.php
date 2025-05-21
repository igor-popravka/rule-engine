<?php

namespace RuleEngine;

interface ActionInterface
{
    public function execute(Context $context): void;
}
