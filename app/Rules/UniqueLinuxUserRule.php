<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueLinuxUserRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $output = [];
        $userAvailable;
        $groupAvailable;
        unset($output);
        exec("id -u " . escapeshellarg($value), $output, $userAvailable);
        exec("grep -q " . escapeshellarg($value) . " /etc/group", $output, $groupAvailable);
        return $userAvailable && $groupAvailable;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
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
