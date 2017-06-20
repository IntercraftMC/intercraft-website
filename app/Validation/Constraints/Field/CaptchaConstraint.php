<?php

// post('g-recaptcha-response')

namespace App\Validation\Constraints\Field;

use App\Captcha;
use Scout\ScoutConstraint;

class CaptchaConstraint extends ScoutConstraint
{
    public function test($value)
    {
        if (empty($value))
            return True;

        return Captcha::response($value)->isSuccess();
    }
}