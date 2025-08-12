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
        return (bool) preg_match(
            $regex,
            $url
        );
    }

    public function detectUrlCategory(string $url): ?string
    {
        $suffix = '/?(?:[?#].*)?$';
        // aceita letras/números/._- ou sequências %HH
        $seg = '((?:[A-Za-z0-9._-]|%[0-9A-Fa-f]{2})+)';

        $profilePatterns = [
            "~^(?:https?://)?(?:[\\w-]+\\.)?linkedin\\.com/in/{$seg}{$suffix}~i",
            "~^(?:https?://)?(?:[\\w-]+\\.)?linkedin\\.com/pub/{$seg}{$suffix}~i",
            "~^(?:https?://)?lnkd\\.in/([A-Za-z0-9]+)" . $suffix . "~i",
        ];

        $postPatterns = [
            "~^(?:https?://)?(?:[\\w-]+\\.)?linkedin\\.com/posts/[^/]+_([^/]+)(?:/|$)(?:\\?.*)?$~i",
            "~^(?:https?://)?(?:[\\w-]+\\.)?linkedin\\.com/feed/update/urn:li:activity:(\\d+)" . $suffix . "~i",
        ];

        $companyPatterns = [
            "~^(?:https?://)?(?:[\\w-]+\\.)?linkedin\\.com/company/{$seg}"
                . "(?:/(?:about|people|posts|jobs|life|updates|insights|events|services)"
                . "(?:/{$seg})?)?{$suffix}~iu",
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
