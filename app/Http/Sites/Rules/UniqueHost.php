<?php

namespace DDD\Http\Sites\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

// Services
use DDD\App\Services\UrlService;

class UniqueHost implements Rule
{
    public $host;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->host = UrlService::getHost($url);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $host_exists = DB::table('sites')
            ->where('host', '=', $this->host)
            ->exists();

        // Return false if site exists, failing validation
        return $host_exists === false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Site with host ' . $this->host . ' already exists';
    }
}
