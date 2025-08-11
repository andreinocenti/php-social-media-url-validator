<?php

namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class FacebookValidator implements PlatformValidator
{
    public function matches(string $url): bool
    {
        $specific = [
            // PROFILE numeric
            '~^(?:https?://)?(?:www\.|m\.|mbasic\.)?facebook\.com/profile\.php\?id=\d+(?:[/?#&].*)?$~i',
            // PROFILE vanity
            '~^(?:https?://)?(?:www\.|m\.|mbasic\.)?facebook\.com/'
                . '(?!(?:posts|videos|watch|reel|groups|story\.php|events|help|gaming|marketplace|messages|notifications|settings|home|plugins|privacy|policies|legal|people|pages|places|permalink)(?:/|$|[?#&]))'
                . '[0-9A-Za-z\.]+(?:/)?(?:[?#&].*)?$~i',

            // POST
            '~^(?:https?://)?(?:www\.|m\.|mbasic\.)?facebook\.com/[^/]+/posts/[A-Za-z0-9_-]+(?:/)?(?:[?#&].*)?$~i',
            '~^(?:https?://)?(?:www\.|m\.|mbasic\.)?facebook\.com/story\.php\?story_fbid=\d+&id=\d+(?:/)?(?:[?#&].*)?$~i',
            '~^(?:https?://)?(?:www\.|m\.|mbasic\.)?facebook\.com/groups/\d+/(?:posts|permalink)/[A-Za-z0-9]+(?:/)?(?:[?#&].*)?$~i',

            // VIDEO
            '~^(?:https?://)?(?:www\.|m\.|mbasic\.)?facebook\.com/(?:video\.php\?v=|[^/]+/videos/)\d+(?:/)?(?:[?#&].*)?$~i',
            '~^(?:https?://)?(?:www\.|m\.|mbasic\.)?facebook\.com/watch(?:/)?\?v=[A-Za-z0-9]+(?:[?#&].*)?$~i',
            '~^(?:https?://)?(?:www\.|m\.|mbasic\.)?facebook\.com/reel/[A-Za-z0-9]+(?:/)?(?:[?#&].*)?$~i',
            '~^(?:https?://)?fb\.watch/[A-Za-z0-9_]+(?:/)?(?:[?#&].*)?$~i',
        ];

        foreach ($specific as $pattern) {
            if (preg_match($pattern, $url)) {
                return true;
            }
        }

        // ✅ Fallback amplo: qualquer URL do Facebook/fb.watch conta como “da plataforma”
        return (bool) preg_match(
            '~^(?:https?://)?(?:(?:www\.|m\.|mbasic\.)?facebook\.com|fb\.watch)(?:/|$)~i',
            $url
        );
    }

    public function detectUrlCategory(string $url): ?string
    {
        // 1) POST primeiro
        $postPatterns = [
            '~^(?:https?://)?(?:www\.|m\.|mbasic\.)?facebook\.com/[^/]+/posts/([A-Za-z0-9_-]+)(?:/)?(?:[?#&].*)?$~i',
            '~^(?:https?://)?(?:www\.|m\.|mbasic\.)?facebook\.com/story\.php\?story_fbid=(\d+)&id=\d+(?:/)?(?:[?#&].*)?$~i',
            '~^(?:https?://)?(?:www\.|m\.|mbasic\.)?facebook\.com/groups/\d+/(?:posts|permalink)/([A-Za-z0-9]+)(?:/)?(?:[?#&].*)?$~i',
        ];
        foreach ($postPatterns as $p) {
            if (preg_match($p, $url)) {
                return PlatformsCategoriesEnum::POST->value;
            }
        }

        // 2) VIDEO
        $videoPatterns = [
            '~^(?:https?://)?(?:www\.|m\.|mbasic\.)?facebook\.com/(?:video\.php\?v=|[^/]+/videos/)(\d+)(?:/)?(?:[?#&].*)?$~i',
            '~^(?:https?://)?(?:www\.|m\.|mbasic\.)?facebook\.com/watch(?:/)?\?v=([A-Za-z0-9]+)(?:[?#&].*)?$~i',
            '~^(?:https?://)?fb\.watch/([A-Za-z0-9_]+)(?:/)?(?:[?#&].*)?$~i',
            '~^(?:https?://)?(?:www\.|m\.|mbasic\.)?facebook\.com/reel/([A-Za-z0-9]+)(?:/)?(?:[?#&].*)?$~i',
        ];
        foreach ($videoPatterns as $p) {
            if (preg_match($p, $url)) {
                return PlatformsCategoriesEnum::VIDEO->value;
            }
        }

        // 3) PROFILE
        $profilePatterns = [
            '~^(?:https?://)?(?:www\.|m\.|mbasic\.)?facebook\.com/profile\.php\?id=(\d+)(?:[/?#&].*)?$~i',
            '~^(?:https?://)?(?:www\.|m\.|mbasic\.)?facebook\.com/'
                . '(?!(?:posts|videos|watch|reel|groups|story\.php|events|help|gaming|marketplace|messages|notifications|settings|home|plugins|privacy|policies|legal|people|pages|places|permalink)(?:/|$|[?#&]))'
                . '([0-9A-Za-z\.]+)(?:/)?(?:[?#&].*)?$~i',
        ];
        foreach ($profilePatterns as $p) {
            if (preg_match($p, $url)) {
                return PlatformsCategoriesEnum::PROFILE->value;
            }
        }

        return null;
    }
}
