<?php

namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class TikTokValidator implements PlatformValidator
{
    public function matches(string $url): bool
    {
        $suffix = '(?:/)?(?:[?#].*)?$';

        $patterns = [
            // Vídeo canônico: /@user/video/{id}
            "~^(?:https?://)?(?:www\\.|m\\.)?tiktok\\.com/@[^/]+/video/([A-Za-z0-9_-]+)" . $suffix . "~i",
            // Mobile legacy: /v/{id}
            "~^(?:https?://)?m\\.tiktok\\.com/v/([A-Za-z0-9_-]+)" . $suffix . "~i",
            // Embeds: /embed/{id} e /embed/v2/{id}
            "~^(?:https?://)?(?:www\\.)?tiktok\\.com/embed/(?:v2/)?([A-Za-z0-9_-]+)" . $suffix . "~i",
            // Short links: vm.tiktok.com, vt.tiktok.com, tiktok.com/t/{code}
            "~^(?:https?://)?(?:vm|vt)\\.tiktok\\.com/([A-Za-z0-9]+)" . $suffix . "~i",
            "~^(?:https?://)?(?:www\\.)?tiktok\\.com/t/([A-Za-z0-9]+)" . $suffix . "~i",
            // Perfil: /@username
            "~^(?:https?://)?(?:www\\.|m\\.)?tiktok\\.com/@([A-Za-z0-9._]+)" . $suffix . "~i",
        ];

        foreach ($patterns as $rx) {
            if (preg_match($rx, $url)) return true;
        }
        return false;
    }

    public function detectUrlCategory(string $url): ?string
    {
        $suffix = '(?:/)?(?:[?#].*)?$';

        // Primeiro VIDEO (todas as variantes)
        $video = [
            "~^(?:https?://)?(?:www\\.|m\\.)?tiktok\\.com/@[^/]+/video/([A-Za-z0-9_-]+)" . $suffix . "~i",
            "~^(?:https?://)?m\\.tiktok\\.com/v/([A-Za-z0-9_-]+)" . $suffix . "~i",
            "~^(?:https?://)?(?:www\\.)?tiktok\\.com/embed/(?:v2/)?([A-Za-z0-9_-]+)" . $suffix . "~i",
            "~^(?:https?://)?(?:vm|vt)\\.tiktok\\.com/([A-Za-z0-9]+)" . $suffix . "~i",
            "~^(?:https?://)?(?:www\\.)?tiktok\\.com/t/([A-Za-z0-9]+)" . $suffix . "~i",
        ];
        foreach ($video as $rx) {
            if (preg_match($rx, $url)) {
                return PlatformsCategoriesEnum::VIDEO->value;
            }
        }

        // Depois PROFILE
        $profile = "~^(?:https?://)?(?:www\\.|m\\.)?tiktok\\.com/@([A-Za-z0-9._]+)" . $suffix . "~i";
        if (preg_match($profile, $url)) {
            return PlatformsCategoriesEnum::PROFILE->value;
        }

        return null;
    }
}
