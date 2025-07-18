<?php
namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class LinkedInValidator implements PlatformValidator
{
    public function matches(string $url): bool
    {
        $regex = '~^
            (?:https?://)?                     # esquema opcional
            (?:[\w-]+\.)?linkedin\.com/        # domínio linkedin.com com subdomínio opcional
            (?:
                in/[^/?#]+ |                   # perfil
                company/[^/?#]+ |              # empresa
                groups/[^/?#]+ |               # grupo
                school/[^/?#]+ |               # escola
                events/[^/?#]+ |               # evento
                pulse/[^/?#]+ |                # artigo Pulse
                feed/update/[^/?#]+ |          # feed update (urn:li:activity…)
                posts/[^/?#]+                  # posts legacy
            )
            (?:[/?#]|$)                        # depois disso vem /, ?, # ou fim da string
        ~ix';
        return (bool) preg_match(
            $regex,
            $url
        );
    }

    public function detectUrlCategory(string $url): ?string
    {
        $suffix = '/?(?:\\?.*)?$';

        $profilePatterns = [
            "~^(?:https?://)?(?:www\\.)?linkedin\\.com/in/([A-Za-z0-9_-]+)" . $suffix . "~i",
            "~^(?:https?://)?(?:www\\.)?linkedin\\.com/pub/([A-Za-z0-9_-]+)" . $suffix . "~i",
            "~^(?:https?://)?lnkd\\.in/([A-Za-z0-9]+)" . $suffix . "~i",
        ];
        $postPatterns = [
            "~^(?:https?://)?(?:www\.)?linkedin\.com/posts/[^/]+_([^/]+)(?:/|$)(?:\?.*)?$~i",
            "~linkedin\\.com/feed/update/urn:li:activity:(\\d+)" . $suffix . "~i",
        ];

        $companyPatterns = [
            "~^(?:https?://)?(?:www\\.)?linkedin\\.com/company/([A-Za-z0-9_-]+)" . $suffix . "~i",
        ];

        foreach ($profilePatterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return PlatformsCategoriesEnum::PROFILE->value;
            }
        }

        foreach ($companyPatterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return PlatformsCategoriesEnum::COMPANY->value;
            }
        }

        foreach ($postPatterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return PlatformsCategoriesEnum::POST->value;
            }
        }

        return null;
    }
}
