<?php
namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class TikTokValidator implements PlatformValidator
{
    public function matches(string $url): bool
    {
        $suffix = '/?(?:\\?.*)?$';
        $matches = [
            "~^(?:https?://)?(?:www\\.)?tiktok\\.com/@[^/]+/video/([A-Za-z0-9_-]+)" . $suffix . "~i",
            "~^(?:https?://)?vm\\.tiktok\\.com/([A-Za-z0-9_-]+)" . $suffix . "~i",
            "~^(?:https?://)?m\\.tiktok\\.com/v/([A-Za-z0-9_-]+)" . $suffix . "~i",
            "~^(?:https?://)?(?:www\\.)?tiktok\\.com/@([A-Za-z0-9._]+)" . $suffix . "~i"
        ];

        return (bool) array_reduce($matches, function ($carry, $pattern) use ($url) {
            return $carry || (bool) preg_match($pattern, $url);
        }, false);
    }

    public function detectUrlCategory(string $url): ?string
    {
        $suffix = '/?(?:\\?.*)?$';
        $videoMatches = [
            "~^(?:https?://)?(?:www\\.)?tiktok\\.com/@[^/]+/video/([A-Za-z0-9_-]+)" . $suffix . "~i",
            "~^(?:https?://)?vm\\.tiktok\\.com/([A-Za-z0-9_-]+)" . $suffix . "~i",
            "~^(?:https?://)?m\\.tiktok\\.com/v/([A-Za-z0-9_-]+)" . $suffix . "~i",
        ];
        $profileMatches = ["~^(?:https?://)?(?:www\\.)?tiktok\\.com/@([A-Za-z0-9._]+)" . $suffix . "~i"];
        if (preg_match($videoMatches[0], $url) || preg_match($videoMatches[1], $url) || preg_match($videoMatches[2], $url)) {
            return PlatformsCategoriesEnum::VIDEO->value;
        }
        if (preg_match($profileMatches[0], $url)) {
            return PlatformsCategoriesEnum::PROFILE->value;
        }
        return null;
    }
}
