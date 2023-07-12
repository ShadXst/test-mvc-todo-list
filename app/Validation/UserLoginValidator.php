<?php

namespace App\Validation;

/**
 * The user login data validation.
 *
 * @package App\Validation
 */
class UserLoginValidator extends BaseValidator
{
    /**
     * @inheritDoc
     */
    public function validate(array $data): array|null
    {
        $config = require __DIR__ . '/../../config/config.php';
        if (!$this->checkRequiredString($data['login'])) {
            $this->setError('login', ValidationError::REQUIRED);
        }
        if (!$this->checkRequiredString($data['password'])) {
            $this->setError('password', ValidationError::REQUIRED);
        }
        if (
            $data['login'] !== $config['admin']['login'] ||
            $data['password'] !== $config['admin']['password']
        ) {
            $this->setError('password', ValidationError::INVALID_CREDENTIALS);
        }
        return $this->getErrors();
    }
}
