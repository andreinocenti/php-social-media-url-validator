<?php
namespace AndreInocenti\SocialMediaUrlValidator;

class UrlValidator
{
    /**
     * Validate a social media URL.
     *
     * @param string $url The URL to validate.
     * @return bool True if the URL is valid, false otherwise.
     */
    static function is_url(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
}