<?php

namespace App\Domain\Users\Rules;

use Laravel\Fortify\Rules\Password;

/**
 * Class PasswordValidationRules
 */
trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        return ['required', 'string', new Password(), 'confirmed'];
    }
}
