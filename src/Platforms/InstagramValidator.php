<?php
namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class InstagramValidator implements PlatformValidator
{
    public function matches(string $url): bool
    {
        return (bool) preg_match(
            '~^https?://(?:www\.)?instagram\.com/(?:[^/]+/)?(p|reel|tv)?/?.+~i',
            $url
        );
    }

    public function detectUrlCategory(string $url): ?string
    {
        if (preg_match('~instagram\.com/p/[^/]+~i', $url)) {
            return PlatformsCategoriesEnum::POST->value;
        }
        if (preg_match('~instagram\.com/reel/[^/]+~i', $url)) {
            return PlatformsCategoriesEnum::REEL->value;
        }
        if (preg_match('~instagram\.com/tv/[^/]+~i', $url)) {
            return PlatformsCategoriesEnum::IGTV->value;
        }
        if (preg_match('~instagram\.com/([^/]+)/?$~i', $url, $m)) {
            return PlatformsCategoriesEnum::PROFILE->value;
        }
        return null;
    }
}
