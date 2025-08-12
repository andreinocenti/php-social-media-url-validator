<?php

namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class FacebookValidator implements PlatformValidator
{
    public function matches(string $url): bool
    {
        $host   = '(?:[\\w-]+\\.)?facebook\\.com';
        $suffix = '(?:/)?(?:[?#&].*)?$';

        $specific = [
            // PROFILE numeric
            "~^(?:https?://)?{$host}/profile\\.php\\?id=\\d+{$suffix}~i",

            // PROFILE vanity (nega rotas reservadas)
            "~^(?:https?://)?{$host}/"
                . "(?!(?:posts|videos|watch|reel|groups|story\\.php|events|help|gaming|marketplace|messages|notifications|settings|home|plugins|privacy|policies|legal|people|pages|places|permalink)(?:/|$|[?#&]))"
                . "[0-9A-Za-z\\.]+{$suffix}~i",

            // POST (page), story.php, grupos (posts|permalink)
            "~^(?:https?://)?{$host}/[^/]+/posts/[A-Za-z0-9_-]+{$suffix}~i",
            "~^(?:https?://)?{$host}/story\\.php\\?story_fbid=\\d+&id=\\d+{$suffix}~i",
            "~^(?:https?://)?{$host}/groups/\\d+/(?:posts|permalink)/[A-Za-z0-9_-]+{$suffix}~i",

            // VIDEO (video.php|/videos/), watch?v=, reel/, fb.watch
            "~^(?:https?://)?{$host}/(?:video\\.php\\?v=|[^/]+/videos/)\\d+{$suffix}~i",
            "~^(?:https?://)?{$host}/watch/?\\?v=[A-Za-z0-9]+(?:[?#&].*)?$~i",
            "~^(?:https?://)?{$host}/reel/[A-Za-z0-9]+{$suffix}~i",
            "~^(?:https?://)?fb\\.watch/[A-Za-z0-9_]+{$suffix}~i",
        ];

        foreach ($specific as $pattern) {
            if (preg_match($pattern, $url)) {
                return true;
            }
        }

        // Fallback: qualquer domínio Facebook/fb.watch
        return (bool) preg_match("~^(?:https?://)?(?:{$host}|fb\\.watch)(?:/|$)~i", $url);
    }

    public function detectUrlCategory(string $url): ?string
    {
        // aceita web., pt-br., es-la., m., mbasic., www., etc.
        $host   = '(?:[\\w-]+\\.)?facebook\\.com';
        // barra final opcional + querystring/fragment opcionais
        $suffix = '(?:/)?(?:[?#&].*)?$';

        // 1) POST primeiro
        $postPatterns = [
            "~^(?:https?://)?{$host}/[^/]+/posts/([A-Za-z0-9_-]+){$suffix}~i",
            "~^(?:https?://)?{$host}/story\\.php\\?story_fbid=(\\d+)&id=\\d+{$suffix}~i",
            "~^(?:https?://)?{$host}/groups/\\d+/(?:posts|permalink)/([A-Za-z0-9_-]+){$suffix}~i",
        ];
        foreach ($postPatterns as $p) {
            if (preg_match($p, $url)) {
                return PlatformsCategoriesEnum::POST->value;
            }
        }

        // 2) VIDEO
        $videoPatterns = [
            "~^(?:https?://)?{$host}/(?:video\\.php\\?v=|[^/]+/videos/)(\\d+){$suffix}~i",
            "~^(?:https?://)?{$host}/watch/?\\?v=([A-Za-z0-9]+)(?:[?#&].*)?$~i",
            "~^(?:https?://)?fb\\.watch/([A-Za-z0-9_]+){$suffix}~i",
            "~^(?:https?://)?{$host}/reel/([A-Za-z0-9]+){$suffix}~i",
        ];
        foreach ($videoPatterns as $p) {
            if (preg_match($p, $url)) {
                return PlatformsCategoriesEnum::VIDEO->value;
            }
        }

        // 3) PROFILE (vanity e numérico)
        $profilePatterns = [
            "~^(?:https?://)?{$host}/profile\\.php\\?id=(\\d+)(?:[/?#&].*)?$~i",
            "~^(?:https?://)?{$host}/"
                . "(?!(?:posts|videos|watch|reel|groups|story\\.php|events|help|gaming|marketplace|messages|notifications|settings|home|plugins|privacy|policies|legal|people|pages|places|permalink)(?:/|$|[?#&]))"
                . "([0-9A-Za-z\\.]+){$suffix}~i",
        ];
        foreach ($profilePatterns as $p) {
            if (preg_match($p, $url)) {
                return PlatformsCategoriesEnum::PROFILE->value;
            }
        }

        return null;
    }
}
