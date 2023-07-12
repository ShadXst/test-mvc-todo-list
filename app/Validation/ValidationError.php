<?php

namespace App\Validation;

enum ValidationError: string
{
    case REQUIRED = 'Required to fill';
    case EMAIL_FORMAT = 'Invalid email format. E.g: user@example.com';
    case INVALID_CREDENTIALS = 'Invalid login or password';
}
