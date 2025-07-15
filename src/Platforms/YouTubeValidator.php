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
            . 'youtube\.com/(?:channel/|user/|c/|watch\?v=|shorts/)|'
            . 'youtu\.be/|'
            . 'youtube-nocookie\.com/embed/'
            . ')~i';

        return (bool) preg_match($regex, $url);
    }

    public function detectUrlCategory(string $url): ?string
    {
        $channelRegex  = '~(?:youtube\.com|m\.youtube\.com)/(?:channel|c|user)/[^/]+~i';
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
        return null;
    }
}
