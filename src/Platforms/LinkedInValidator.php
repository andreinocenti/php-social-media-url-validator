<?php
namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class LinkedInValidator implements PlatformValidator
{
    public function matches(string $url): bool
    {
        $regex = '~^
        (?:https?://)?
        (?:
            (?:[\w-]+\.)?linkedin\.com/
            (?:
                in/[^/?#]+ |
                company/[^/?#]+(?:/(?:about|people|posts|jobs|life|updates|insights|events|services)(?:/[^/?#]+)?)? |
                showcase/[^/?#]+(?:/(?:about|people|posts|jobs|life|updates|insights|events|services)(?:/[^/?#]+)?)? |
                groups/[^/?#]+ |
                school/[^/?#]+ |
                events/[^/?#]+ |
                pulse/[^/?#]+  |
                feed/update/[^/?#]+ |
                posts/[^/?#]+
            )
        | lnkd\.in/[^/?#]+
        )
        (?:[/?#]|$)
    ~ix';

        return (bool) preg_match($regex, $url);
}

    public function detectUrlCategory(string $url): ?string
    {
        $suffix = '/?(?:[?#].*)?$';

        // slug com unicode + %XX + alguns símbolos comuns em slugs do LinkedIn
        $seg = "((?:%[0-9A-Fa-f]{2}|[\\p{L}\\p{N}._'&()+,-])+)";
        // /pt, /de, /en-us… opcional após o slug de perfil
        $locale = "(?:/[a-z]{2,5}(?:-[a-z]{2,5})?)?";

        // PERFIL (/in/… ou /pub/…)
        $profilePatterns = [
            "~^(?:https?://)?(?:[\\w-]+\\.)?linkedin\\.com/in/{$seg}{$locale}{$suffix}~iu",
            "~^(?:https?://)?(?:[\\w-]+\\.)?linkedin\\.com/pub/{$seg}{$locale}{$suffix}~iu",
            "~^(?:https?://)?lnkd\\.in/([A-Za-z0-9]+){$suffix}~i",
        ];

        // POSTS (activity)
        $postPatterns = [
            "~^(?:https?://)?(?:[\\w-]+\\.)?linkedin\\.com/posts/[^/]+_([^/]+)(?:/|$)(?:\\?.*)?$~i",
            "~^(?:https?://)?(?:[\\w-]+\\.)?linkedin\\.com/feed/update/urn:li:activity:(\\d+){$suffix}~i",
        ];

        // COMPANY (inclui company|showcase|school) + abas e até 2 sub-segmentos
        $companyPatterns = [
            "~^(?:https?://)?(?:[\\w-]+\\.)?linkedin\\.com/(?:company|showcase|school)/{$seg}"
                . "(?:/(?:about|people|posts|jobs|life|updates|insights|events|services|admin)"
                . "(?:/{$seg}){0,2})?{$suffix}~iu",
        ];

        // GROUPS
        $groupPatterns = [
            "~^(?:https?://)?(?:[\\w-]+\\.)?linkedin\\.com/groups/([A-Za-z0-9]+)(?:/)?(?:[?#].*)?$~i",
        ];

        foreach ($postPatterns as $p) {
            if (preg_match($p, $url)) return PlatformsCategoriesEnum::POST->value;
        }
        foreach ($companyPatterns as $p) {
            if (preg_match($p, $url)) return PlatformsCategoriesEnum::COMPANY->value;
        }
        foreach ($groupPatterns as $p) {
            if (preg_match($p, $url)) return PlatformsCategoriesEnum::GROUP->value;
        }
        foreach ($profilePatterns as $p) {
            if (preg_match($p, $url)) return PlatformsCategoriesEnum::PROFILE->value;
        }

        return null;
    }
}
