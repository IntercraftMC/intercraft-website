<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Support\Captcha;

class CaptchaRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        echo $result = Captcha::check($value) === True;
        return $result;
    }

    /**
     * Determine if the validation rule is valid.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    public function validate($attribute, $value, $parameters, $validator)
    {
        return $this->passes($attribute, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
