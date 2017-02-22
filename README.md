# laravel-validation-rule-registration
A package that is designed to help aid rapid development and registration of custom Validation Rules in Laravel

## Usage

1. Create your Validation Rule class, ensure it implements the `Joshbrw\ValidationRule\Contracts\ValidationRule` contract.
2. In your service provider `use RegistersValidationRules`
3. In the `boot()` method of your service provider;
    * To register a validation rule: `$this->registerValidationRule('rule_name', RuleClass::class)`
    * To register a validation replacer: `$this->registerValidationReplacer('rule_name', RuleClass::class);`
