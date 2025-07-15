<?php
namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class TikTokValidator implements PlatformValidator
{
    public function matches(string $url): bool
    {
        return (bool) preg_match(
            '~^https?://(?:www\.)?tiktok\.com/(?:@[^/]+/video/\d+|@[^/]+)/?~i',
            $url
        );
    }

    public function detectUrlCategory(string $url): ?string
    {
        if (preg_match('~tiktok\.com/@[^/]+/video/\d+~i', $url)) {
            return PlatformsCategoriesEnum::VIDEO->value;
        }
        if (preg_match('~tiktok\.com/@([^/]+)/?$~i', $url)) {
            return PlatformsCategoriesEnum::PROFILE->value;
        }
        return null;
    }
}
