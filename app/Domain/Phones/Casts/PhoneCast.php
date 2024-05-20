<?php

namespace DDD\Domain\Phones\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class PhoneCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        return $value;
    }

    public function set($model, $key, $value, $attributes)
    {
        if (preg_match('/^\+[0-9]([0-9]{3})([0-9]{3})([0-9]{4})$/',  $value, $phone)) { 
            $formatted = '(' . $phone[1] . ') ' .  $phone[2] . '-' . $phone[3]; 
        } 
        else { 
            throw new \Exception('Invalid phone number format');
        } 
        
        return $formatted;
    }
}
