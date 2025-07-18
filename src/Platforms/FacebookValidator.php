<?php
namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class FacebookValidator implements PlatformValidator
{
    public function matches(string $url): bool
    {
        $matches = [
            '~^(?:https?://)?(?:www\.|m\.)?facebook\.com/profile\.php\?id=(\d+)(?:/|\b)(?:\?.*)?$~i',
            '~^(?:https?://)?(?:www\.|m\.)?facebook\.com/([0-9A-Za-z\.]+)(?:/|\b)(?:\?.*)?$~i',
            '~^(?:https?://)?(?:www\.|m\.)?facebook\.com/[^/]+/posts/(\d+)(?:/|\b)(?:\?.*)?$~i',
            '~^(?:https?://)?(?:www\.|m\.)?facebook\.com/story\.php\?story_fbid=(\d+)&id=\d+(?:/|\b)(?:\?.*)?$~i',
            '~^(?:https?://)?(?:www\.|m\.)?facebook\.com/(?:video\.php\?v=|[^/]+/videos/)(\d+)(?:/|\b)(?:\?.*)?$~i',
            '~^(?:https?://)?fb\.watch/([A-Za-z0-9_]+)(?:/|\b)(?:\?.*)?$~i',
        ];

        return (bool) array_reduce($matches, function ($carry, $pattern) use ($url) {
            return $carry || (bool) preg_match($pattern, $url);
        }, false);
    }

    public function detectUrlCategory(string $url): ?string
    {
        $profilePatterns = [
            '~^(?:https?://)?(?:www\.|m\.)?facebook\.com/profile\.php\?id=(\d+)(?:/|\b)(?:\?.*)?$~i',
            '~^(?:https?://)?(?:www\.|m\.)?facebook\.com/([0-9A-Za-z\.]+)(?:/|\b)(?:\?.*)?$~i',
        ];
        $postPatterns = [
            '~^(?:https?://)?(?:www\.|m\.)?facebook\.com/[^/]+/posts/(\d+)(?:/|\b)(?:\?.*)?$~i',
            '~^(?:https?://)?(?:www\.|m\.)?facebook\.com/story\.php\?story_fbid=(\d+)&id=\d+(?:/|\b)(?:\?.*)?$~i',
        ];
        $videoPatterns = [
            '~^(?:https?://)?(?:www\.|m\.)?facebook\.com/(?:video\.php\?v=|[^/]+/videos/)(\d+)(?:/|\b)(?:\?.*)?$~i',
            '~^(?:https?://)?fb\.watch/([A-Za-z0-9_]+)(?:/|\b)(?:\?.*)?$~i',
        ];

        // matches should be checked iterable
        foreach ($postPatterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return PlatformsCategoriesEnum::POST->value;
            }
        }

        foreach ($profilePatterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return PlatformsCategoriesEnum::PROFILE->value;
            }
        }


        foreach ($videoPatterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return PlatformsCategoriesEnum::VIDEO->value;
            }
        }

        // if (preg_match('~facebook\.com/profile\.php\?id=\d+~i', $url)) {
        //     return PlatformsCategoriesEnum::PROFILE->value;
        // }
        // if (preg_match('~facebook\.com/[^/]+/posts/\d+~i', $url)) {
        //     return PlatformsCategoriesEnum::POST->value;
        // }
        // if (preg_match('~facebook\.com/([^/]+)/?$~i', $url)) {
        //     return PlatformsCategoriesEnum::PAGE->value;
        // }
        return null;
    }
}
