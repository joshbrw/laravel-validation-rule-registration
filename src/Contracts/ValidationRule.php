<?php

namespace Joshbrw\ValidationRule\Contracts;

use Illuminate\Contracts\Validation\Validator;

interface ValidationRule
{
    /**
     * Validate an attribute
     * @param string $attribute The attribute's name
     * @param string $value The attribute's value
     * @param array $parameters Any parameters passed to the validation rule
     * @param Validator $validator The validator instance
     * @return bool
     */
    public function validate(string $attribute, string $value, array $parameters, Validator $validator): bool;

    /**
     * Run any required error message string replacements for this validation rule.
     * @param string $message
     * @param string $attribute
     * @param string $rule
     * @param array $parameters
     * @return string
     */
    public function replacer(string $message, string $attribute, string $rule, array $parameters): string;
}
