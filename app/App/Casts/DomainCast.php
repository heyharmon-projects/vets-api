<?php

namespace DDD\App\Casts;

use Spatie\Url\Url;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class DomainCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        return $value;
    }

    public function set($model, $key, $value, $attributes)
    {
        $url = Url::fromString($value); // E.g. 'https://spatie.be/opensource'
        $scheme = $url->getScheme(); // 'https'
        $host = $url->getHost(); // 'spatie.be'

        if ($scheme && $host) {
            return $scheme . '://' . $host; // 'https://spatie.be'
        }
    }
}
