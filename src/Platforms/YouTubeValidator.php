<?php

namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class YouTubeValidator implements PlatformValidator
{
    private const SUFFIX = '(?:/)?(?:[?#].*)?$';
    private const YT    = '(?:www\.|m\.)?youtube\.com';

    // ---- Patterns reutilizáveis
    private const RX_WATCH   = '~^(?:https?://)?' . self::YT . '/watch(?:/)?\?[^#\s]*\bv=([A-Za-z0-9_-]+)\b[^#\s]*$~i';
    private const RX_YTBE    = '~^(?:https?://)?youtu\.be/([A-Za-z0-9_-]+)' . self::SUFFIX . '~i';
    private const RX_EMBED   = '~^(?:https?://)?(?:www\.)?youtube(?:-nocookie)?\.com/embed/([A-Za-z0-9_-]+)' . self::SUFFIX . '~i';
    private const RX_SHORTS  = '~^(?:https?://)?(?:www\.|m\.)?youtube\.com/shorts/([A-Za-z0-9_-]+)' . self::SUFFIX . '~i';

    private const RX_CHID    = '~^(?:https?://)?(?:www\.)?youtube\.com/channel/([A-Za-z0-9_-]+)' . self::SUFFIX . '~i';
    private const RX_USER    = '~^(?:https?://)?(?:www\.)?youtube\.com/user/([A-Za-z0-9_-]+)' . self::SUFFIX . '~i';
    private const RX_CUSTOM  = '~^(?:https?://)?(?:www\.)?youtube\.com/c/([A-Za-z0-9_-]+)' . self::SUFFIX . '~i';
    private const RX_HANDLE  = '~^(?:https?://)?(?:www\.)?youtube\.com/@([A-Za-z0-9._-]+)(?:/(?:featured|videos|shorts|streams|about|community|playlists))?' . self::SUFFIX . '~i';

    private const RESERVED   = '(?:watch|playlist|shorts|channel|user|c|feed|results|account|about|premium|upload|signin|redirect|embed|t|@)';
    private const RX_ROOT    = '~^(?:https?://)?(?:www\.)?youtube\.com/(?!(?:' . self::RESERVED . ')(?:/|$|[?#&]))([A-Za-z0-9_-]+)(?:/(?:featured|videos|shorts|streams|about|community|playlists))?' . self::SUFFIX . '~i';

    private const RX_PLAY    = '~^(?:https?://)?(?:www\.)?youtube\.com/playlist\?[^#\s]*\blist=([A-Za-z0-9_-]+)\b[^#\s]*$~i';

    public function matches(string $url): bool
    {
        // Só considera “YouTube válido” quando há ID presente.
        $patterns = [
            self::RX_WATCH,
            self::RX_YTBE,
            self::RX_EMBED,
            self::RX_SHORTS,
            self::RX_CHID,
            self::RX_USER,
            self::RX_CUSTOM,
            self::RX_HANDLE,
            self::RX_ROOT,
            self::RX_PLAY,
        ];
        foreach ($patterns as $rx) {
            if (preg_match($rx, $url)) return true;
        }
        return false;
    }

    public function detectUrlCategory(string $url): ?string
    {
        // VIDEO (watch, youtu.be, embed)
        if (preg_match(self::RX_WATCH, $url) || preg_match(self::RX_YTBE, $url) || preg_match(self::RX_EMBED, $url)) {
            return PlatformsCategoriesEnum::VIDEO->value;
        }
        // SHORTS
        if (preg_match(self::RX_SHORTS, $url)) {
            return PlatformsCategoriesEnum::SHORTS->value;
        }
        // PLAYLIST (somente /playlist?list=..., não confundir com watch&list=...)
        if (preg_match(self::RX_PLAY, $url)) {
            return PlatformsCategoriesEnum::PLAYLIST->value;
        }
        // USER legacy
        if (preg_match(self::RX_USER, $url)) {
            return PlatformsCategoriesEnum::USER->value;
        }
        // CUSTOM (/c/...)
        if (preg_match(self::RX_CUSTOM, $url)) {
            return PlatformsCategoriesEnum::CUSTOM->value;
        }
        // CHANNEL: handle, channel id e root custom
        if (preg_match(self::RX_HANDLE, $url) || preg_match(self::RX_CHID, $url) || preg_match(self::RX_ROOT, $url)) {
            return PlatformsCategoriesEnum::CHANNEL->value;
        }
        return null;
    }
}
