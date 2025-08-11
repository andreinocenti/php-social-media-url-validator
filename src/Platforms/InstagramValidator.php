<?php

namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class InstagramValidator implements PlatformValidator
{
    /** Sufixo padrão: slash opcional + query/fragment opcionais */
    private const SUFFIX = '(?:/)?(?:[?#].*)?$';

    /** Rotas reservadas que NÃO são perfil */
    private const RESERVED = '(?:p|reel|tv|stories|accounts|explore|about|directory|developer|privacy|help|policies|legal|tags|challenge|sessions|web|graphql|api|ads|press|business|creators)';

    /** Padrões reutilizáveis */
    private const RX_POST   = '~^(?:https?://)?(?:www\.)?instagram\.com/p/([A-Za-z0-9_-]+)' . self::SUFFIX . '~i';
    private const RX_REEL   = '~^(?:https?://)?(?:www\.)?instagram\.com/reel/([A-Za-z0-9_-]+)' . self::SUFFIX . '~i';
    private const RX_IGTV   = '~^(?:https?://)?(?:www\.)?instagram\.com/tv/([A-Za-z0-9_-]+)' . self::SUFFIX . '~i';
    private const RX_STORY1 = '~^(?:https?://)?(?:www\.)?instagram\.com/stories/([A-Za-z0-9._]+)/([A-Za-z0-9_-]+)' . self::SUFFIX . '~i'; // user story
    private const RX_STORY2 = '~^(?:https?://)?(?:www\.)?instagram\.com/stories/highlights/([0-9]+)' . self::SUFFIX . '~i';              // highlight
    private const RX_PROF   = '~^(?:https?://)?(?:www\.)?instagram\.com/'
        . '(?!(?:' . self::RESERVED . ')(?:/|$|[?#]))'
        . '([A-Za-z0-9._]+)' . self::SUFFIX . '~i';

    public function matches(string $url): bool
    {
        return preg_match(self::RX_POST, $url)
            || preg_match(self::RX_REEL, $url)
            || preg_match(self::RX_IGTV, $url)
            || preg_match(self::RX_STORY1, $url)
            || preg_match(self::RX_STORY2, $url)
            || preg_match(self::RX_PROF, $url);
    }

    public function detectUrlCategory(string $url): ?string
    {
        // Ordem importa: tipos específicos antes de perfil
        if (preg_match(self::RX_POST, $url))   return PlatformsCategoriesEnum::POST->value;
        if (preg_match(self::RX_REEL, $url))   return PlatformsCategoriesEnum::REEL->value;
        if (preg_match(self::RX_IGTV, $url))   return PlatformsCategoriesEnum::IGTV->value;
        if (preg_match(self::RX_STORY1, $url) || preg_match(self::RX_STORY2, $url)) {
            return PlatformsCategoriesEnum::STORY->value;
        }
        if (preg_match(self::RX_PROF, $url))   return PlatformsCategoriesEnum::PROFILE->value;
        return null;
    }
}
