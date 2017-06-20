<?php

namespace App\Validation\Constraints\Field;

use App\Mojang\Mojang;
use Scout\ScoutConstraint;

class MinecraftUserConstraint extends ScoutConstraint
{
    public function test($value)
    {
        if (empty($value))
            return True;

        return Mojang::userExists($value);
    }
}