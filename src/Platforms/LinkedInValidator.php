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
        if (preg_match('~linkedin\.com/in/([^/]+)~i', $url)) {
            return PlatformsCategoriesEnum::PROFILE->value;
        }
        if (preg_match('~linkedin\.com/company/([^/]+)~i', $url)) {
            return PlatformsCategoriesEnum::COMPANY->value;
        }
        if (preg_match('~^(?:https?://)?(?:[\w-]+\.)?linkedin\.com/(?:pulse/[^/?#]+ | feed/update/[^/?#]+ | posts/[^/?#]+)(?:[/?#]|$)~ix', $url)) {
            return PlatformsCategoriesEnum::POST->value;
        }
        return null;
    }
}
