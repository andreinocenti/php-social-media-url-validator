<?php

namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class XValidator implements PlatformValidator
{
    private const SUFFIX   = '(?:/)?(?:[?#].*)?$';
    private const SUB      = '(?:www\.|mobile\.)?';
    private const DOMAIN   = '(?:twitter\.com|x\.com)';
    private const USER     = '([A-Za-z0-9_]{1,15})';

    // slugs que NÃO são usernames
    private const RESERVED = '(?:'
        . 'home|explore|search|hashtag|notifications|messages|compose|settings|'
        . 'i|intent|share|privacy|tos|about|help|login|signup|topics|lists|'
        . 'communities|bookmarks|bookmark|directory|jobs|developers|ads|account|oauth'
        . ')(?:/|$|[?#])';

    // Perfis (agora com negative lookahead para RESERVED)
    private const RX_PROFILE  = '~^(?:https?://)?' . self::SUB . self::DOMAIN . '/'
        . '(?!' . self::RESERVED . ')' . self::USER . self::SUFFIX . '~i';

    // Tweets
    private const RX_STATUS   = '~^(?:https?://)?' . self::SUB . self::DOMAIN . '/' . self::USER . '/status/(\d+)(?:/(?:photo|video)/\d+)?' . self::SUFFIX . '~i';
    private const RX_STATUSES = '~^(?:https?://)?' . self::SUB . self::DOMAIN . '/' . self::USER . '/statuses/(\d+)(?:/(?:photo|video)/\d+)?' . self::SUFFIX . '~i';
    private const RX_IWEB     = '~^(?:https?://)?' . self::SUB . self::DOMAIN . '/i/web/status/(\d+)' . self::SUFFIX . '~i';

    // t.co (matches true; categoria null)
    private const RX_TCO      = '~^(?:https?://)?t\.co/[^/\s]+(?:/.*)?$~i';

    public function matches(string $url): bool
    {
        return preg_match(self::RX_STATUS, $url)
            || preg_match(self::RX_STATUSES, $url)
            || preg_match(self::RX_IWEB, $url)
            || preg_match(self::RX_PROFILE, $url)
            || preg_match(self::RX_TCO, $url);
    }

    public function detectUrlCategory(string $url): ?string
    {
        if (preg_match(self::RX_STATUS, $url) || preg_match(self::RX_STATUSES, $url) || preg_match(self::RX_IWEB, $url)) {
            return PlatformsCategoriesEnum::POST->value;
        }
        if (preg_match(self::RX_PROFILE, $url)) {
            return PlatformsCategoriesEnum::PROFILE->value;
        }
        return null;
    }
}
