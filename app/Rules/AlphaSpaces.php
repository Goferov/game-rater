<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AlphaSpaces implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/(^[A-Za-z0-9 ]+$)+/', $value)) {
            $fail(__('Pole :attribute moze zawierać tylko litery, cyfry i spacje', ['attribute' => $attribute]));
        }
    }
}
