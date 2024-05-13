<?php

namespace DDD\App\Services\Favicon;

use Spatie\Url\Url;
use DDD\App\Services\Favicon\FaviconInterface;

class IconHorse implements FaviconInterface
{
    /**
     * Get favicon from icon.horse
     * 
     * Docs: https://icon.horse/usage
     * Test URL: https://icon.horse/icon/vetframe.com
     */
    public function take(string $url, string $size = 'small')
    {
        $fullUrl = Url::fromString($url); // E.g. 'https://vetframe.com
        $host = $fullUrl->getHost(); // 'vetframe.com'

        return 'https://icon.horse/icon/' . $host;
    }
}
