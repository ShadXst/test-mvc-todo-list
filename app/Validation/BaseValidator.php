<?php

namespace App\Validation;


/**
 * Base validator.
 *
 * @package App\Validation
 */
abstract class BaseValidator
{
    private array $errors = [];

    /**
     * Validate the request data.
     *
     * @param array $data Data in assoc. format [ 'key' => 'value' ].
     * @return array|null Errors array or null if no errors found.
     */
    abstract public function validate(array $data): array|null;

    /**
     * Validate the required string for emptiness.
     *
     * @param string $value
     * @return bool
     */
    public function checkRequiredString(string $value): bool
    {
        return trim($value) !== '';
    }

    /**
     * Validate the email.
     *
     * @param string $value
     * @return bool
     */
    public function checkEmail(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Set the error.
     *
     * @param string $key Error key.
     * @param ValidationError $validationError
     * @return void
     */
    public function setError(string $key, ValidationError $validationError): void
    {
        $this->errors[$key] = $validationError->value;
    }

    public function getErrors(): array|null
    {
        return empty($this->errors) ? null : $this->errors;
    }
}
