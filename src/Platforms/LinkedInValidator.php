<?php
namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class LinkedInValidator implements PlatformValidator
{
    public function matches(string $url): bool
    {
        return (bool) preg_match(
            '~^https?://(?:[\w]+\.)?linkedin\.com/(?:in|company|feed/update)/~i',
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
        if (preg_match('~linkedin\.com/feed/update/urn:li:activity:\d+~i', $url)) {
            return PlatformsCategoriesEnum::POST->value;
        }
        return null;
    }
}
