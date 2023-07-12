<?php

namespace App\Validation;

/**
 * The task creation data validator.
 *
 * @package App\Validation
 */
class TaskStoreValidator extends BaseValidator
{
    /**
     * @inheritDoc
     */
    public function validate(array $data): array|null
    {
        if (!$this->checkRequiredString($data['username'])) {
            $this->setError('username', ValidationError::REQUIRED);
        }
        if (!$this->checkRequiredString($data['email'])) {
            $this->setError('email', ValidationError::REQUIRED);
        } else if (!$this->checkEmail($data['email'])) {
            $this->setError('email', ValidationError::EMAIL_FORMAT);
        }
        if (!$this->checkRequiredString($data['task_text'])) {
            $this->setError('task_text', ValidationError::REQUIRED);
        }
        return $this->getErrors();
    }
}
