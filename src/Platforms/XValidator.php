<?php
namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class XValidator implements PlatformValidator
{
    public function matches(string $url): bool
    {
        $regex = '~^https?://(?:www\.)?(?:twitter\.com|mobile\.twitter\.com|m\.twitter\.com|x\.com|t\.co)/[^/]+(?:/status/\\d+)?~i';
        return (bool) preg_match($regex, $url);
    }

    public function detectUrlCategory(string $url): ?string
    {
        $postRegex = '~^(?:https?://(?:www\.)?(?:twitter\.com|mobile\.twitter\.com|m\.twitter\.com|x\.com))/[^/]+/status/(\d+)~i';
        $profileRegex = '~^(?:https?://(?:www\.)?(?:twitter\.com|mobile\.twitter\.com|m\.twitter\.com|x\.com))/([^/]+)~i';
        if (preg_match($postRegex,$url)) {
            return PlatformsCategoriesEnum::POST->value;
        }
        if (preg_match($profileRegex, $url)) {
            return PlatformsCategoriesEnum::PROFILE->value;
        }
        return null;
    }
}
