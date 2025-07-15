<?php
namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class FacebookValidator implements PlatformValidator
{
    public function matches(string $url): bool
    {
        return (bool) preg_match(
            '~^https?://(?:www\.)?facebook\.com/(?:profile\.php\?id=\d+|[^/]+/posts/\d+|[^/]+)/?~i',
            $url
        );
    }

    public function detectUrlCategory(string $url): ?string
    {
        if (preg_match('~facebook\.com/profile\.php\?id=\d+~i', $url)) {
            return PlatformsCategoriesEnum::PROFILE->value;
        }
        if (preg_match('~facebook\.com/[^/]+/posts/\d+~i', $url)) {
            return PlatformsCategoriesEnum::POST->value;
        }
        if (preg_match('~facebook\.com/([^/]+)/?$~i', $url)) {
            return PlatformsCategoriesEnum::PAGE->value;
        }
        return null;
    }
}
