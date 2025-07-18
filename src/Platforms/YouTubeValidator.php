<?php
namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class YouTubeValidator implements PlatformValidator
{
    public function matches(string $url): bool
    {
        $regex = '~^https?://'
            . '(?:www\.|m\.)?'
            . '(?:'
            . 'youtube\.com/(?:channel/|user/|c/|watch\?v=|shorts/|playlist)(?:\?.*)?|'
            . 'youtu\.be/(?:[A-Za-z0-9_-]+)(?:\?.*)?|'
            . 'youtube-nocookie\.com/embed/(?:[A-Za-z0-9_-]+)(?:\?.*)?'
            . ')~i';
        return (bool) preg_match($regex, $url);
    }

    public function detectUrlCategory(string $url): ?string
    {
        $channelRegex  = "~^(?:https?://)?(?:www\.)?youtube\.com/channel/([A-Za-z0-9_-]+)(?:/)?(?:[&?].*)?$~i";
        $userRegex     = "~^(?:https?://)?(?:www\.)?youtube\.com/user/([A-Za-z0-9_-]+)(?:/)?(?:[&?].*)?$~i";
        $customRegex   = "~^(?:https?://)?(?:www\.)?youtube\.com/c/([A-Za-z0-9_-]+)(?:/)?(?:[&?].*)?$~i";
        $playlistRegex = "~[?&]list=([A-Za-z0-9_-]+)(?:[&?].*)?$~i";
        $videoRegex    = '~(?:youtu\.be/|youtube\.com/watch\?v=)[^&\s]+~i';
        $shortsRegex   = '~(?:youtube\.com|m\.youtube\.com)/shorts/[^/]+~i';
        $embedRegex    = '~youtube-nocookie\.com/embed/[^/]+~i';

        if (preg_match($channelRegex, $url)) {
            return PlatformsCategoriesEnum::CHANNEL->value;
        }
        if (preg_match($videoRegex, $url)) {
            return PlatformsCategoriesEnum::VIDEO->value;
        }
        if (preg_match($shortsRegex, $url)) {
            return PlatformsCategoriesEnum::SHORTS->value;
        }
        if (preg_match($embedRegex, $url)) {
            return PlatformsCategoriesEnum::VIDEO->value;
        }
        if (preg_match($userRegex, $url)) {
            return PlatformsCategoriesEnum::USER->value;
        }
        if (preg_match($playlistRegex, $url)) {
            return PlatformsCategoriesEnum::PLAYLIST->value;
        }
        if (preg_match($customRegex, $url)) {
            return PlatformsCategoriesEnum::CUSTOM->value;
        }
        return null;
    }
}
