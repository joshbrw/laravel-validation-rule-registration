<?php

namespace Joshbrw\ValidationRule\Traits;

use Illuminate\Contracts\Validation\Factory;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;
use Joshbrw\ValidationRule\Contracts\ValidationRule;
use RuntimeException;

trait RegistersValidationRules
{

    /**
     * @var Factory
     */
    protected $validationFactory;

    /**
     * Register a Validation Rule
     * @param string $ruleName The name of the rule, i.e. 'valid_job_id'
     * @param string $ruleClass The fully-qualified classname of the class to use.
     * @return bool
     */
    public function registerValidationRule(string $ruleName, string $ruleClass): bool
    {
        $this->ensureServiceProvider();

        $this->getValidationFactory()->extend($ruleName, [$ruleClass, 'validate']);
    }

    /**
     * Register a Service Provider
     * @param string $ruleName The name of the rule, i.e. 'valid_job_id'
     * @param string $replacerClass The fully-qualified classname of the class to use.
     * @return bool
     */
    public function registerValidationReplacer(string $ruleName, string $replacerClass): bool
    {
        $this->ensureServiceProvider();

        $this->getValidationFactory()->replacer($ruleName, [$replacerClass, 'replace']);
    }

    /**
     * Ensure we're attached to a Service Provider
     */
    protected function ensureServiceProvider(): void
    {
        if (!$this instanceof ServiceProvider) {
            throw new RuntimeException("The RegistersValidationRule trait should only be applied to Service Providers.");
        }
    }

    /**
     * Ensure that a classname is an instance of the ValidationRule contract
     * @param string $class
     * @return void
     */
    protected function ensureClassIsValidationRule(string $class): void
    {
        if (!$this->app->make($class) instanceof ValidationRule) {
            throw new InvalidArgumentException("Cannot register {$class} as a Validation Rule - it must implement the ValidationRule interface.");
        }
    }

    /**
     * Get the Validation Factory
     * @return Factory
     */
    protected function getValidationFactory(): Factory
    {
        if (!$this->validationFactory instanceof Factory) {
            $this->validationFactory = $this->app->make(Factory::class);
        }

        return $this->validationFactory;
    }
}

