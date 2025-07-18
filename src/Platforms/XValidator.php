<?php
namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class XValidator implements PlatformValidator
{
    public function matches(string $url): bool
    {
        $regex = '~^https?://(?:www\\.|mobile\\.)?(?:twitter\\.com|x\\.com|t\.co)/[^/]+(?:/status/\\d+)?~i';

        return (bool) preg_match($regex, $url);
    }

    public function detectUrlCategory(string $url): ?string
    {
        $suffix = '/?(?:\\?.*)?$';

        $profilePatterns = "~^(?:https?://)?(?:www\\.|mobile\\.)?(?:twitter\\.com|x\\.com)/([A-Za-z0-9_]{1,15})" . $suffix . "~i";
        $postPatterns = [
            "~^(?:https?://)?(?:www\\.|mobile\\.)?(?:twitter\\.com|x\\.com)/[^/]+/status/(\\d+)" . $suffix . "~i",
            "~^(?:https?://)?(?:www\\.|mobile\\.)?(?:twitter\\.com|x\\.com)/i/web/status/(\\d+)" . $suffix . "~i",
        ];
        foreach ($postPatterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return PlatformsCategoriesEnum::POST->value;
            }
        }
        if (preg_match($profilePatterns, $url)) {
            return PlatformsCategoriesEnum::PROFILE->value;
        }
        return null;
    }
}
