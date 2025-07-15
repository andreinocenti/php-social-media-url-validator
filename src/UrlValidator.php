<?php
namespace AndreInocenti\SocialMediaUrlValidator;

use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsEnum;
use AndreInocenti\SocialMediaUrlValidator\Platforms\FacebookValidator;
use AndreInocenti\SocialMediaUrlValidator\Platforms\InstagramValidator;
use AndreInocenti\SocialMediaUrlValidator\Platforms\LinkedInValidator;
use AndreInocenti\SocialMediaUrlValidator\Platforms\TikTokValidator;
use AndreInocenti\SocialMediaUrlValidator\Platforms\XValidator;
use AndreInocenti\SocialMediaUrlValidator\Platforms\YouTubeValidator;

class UrlValidator
{
    /** @var PlatformValidator[] */
    protected array $platformValidators;

    public function __construct()
    {
        $this->platformValidators = [
            new InstagramValidator,
            new TikTokValidator,
            new XValidator,
            new LinkedInValidator,
            new YouTubeValidator,
            new FacebookValidator,
        ];
    }

    public function isInstagram(string $url): bool
    {
        return (new InstagramValidator)->matches($url);
    }

    public function instagramCategory(string $url): ?string
    {
        return (new InstagramValidator)->detectUrlCategory($url);
    }

    // repeat for each platform...

    public function isX(string $url): bool
    {
        return (new XValidator)->matches($url);
    }

    public function isTwitter(string $url): bool
    {
        return $this->isX($url); // XValidator is used for Twitter URLs
    }

    public function xCategory(string $url): ?string
    {
        return (new XValidator)->detectUrlCategory($url);
    }

    public function twitterCategory(string $url): ?string
    {
        return $this->xCategory($url); // XValidator is used for Twitter URLs
    }

    public function isFacebook(string $url): bool
    {
        return (new FacebookValidator)->matches($url);
    }

    public function facebookCategory(string $url): ?string
    {
        return (new FacebookValidator)->detectUrlCategory($url);
    }

    public function isLinkedIn(string $url): bool
    {
        return (new LinkedInValidator)->matches($url);
    }

    public function linkedInCategory(string $url): ?string
    {
        return (new LinkedInValidator)->detectUrlCategory($url);
    }

    public function isTikTok(string $url): bool
    {
        return (new TikTokValidator)->matches($url);
    }

    public function tiktokCategory(string $url): ?string
    {
        return (new TikTokValidator)->detectUrlCategory($url);
    }

    public function isYouTube(string $url): bool
    {
        return (new YouTubeValidator)->matches($url);
    }

    public function youtubeCategory(string $url): ?string
    {
        return (new YouTubeValidator)->detectUrlCategory($url);
    }


    public function detectSocialMedia(string $url): ?string
    {
        $className = null;
        foreach ($this->platformValidators as $validator) {
            if ($validator->matches($url)) {
                $className = (new \ReflectionClass($validator))->getShortName(); // ex: "FacebookValidator"
                break;
            }
        }

        return $className
            ? PlatformsEnum::getByShortValidatorClass($className)->value
            : null;
    }

    public function detectSocialMediaCategory(string $url): ?string
    {
        foreach ($this->platformValidators as $validator) {
            if ($validator->matches($url)) {
                return $validator->detectUrlCategory($url);
            }
        }
        return null;
    }

    /**
     * Validate if the url is valid.
     *
     * @param string $url The URL to validate.
     * @return bool True if the URL is valid, false otherwise.
     */
    function isUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
}