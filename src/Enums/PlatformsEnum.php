<?php
namespace AndreInocenti\SocialMediaUrlValidator\Enums;

enum PlatformsEnum: string
{
    case INSTAGRAM = 'Instagram';
    case TIKTOK = 'Tiktok';
    case X = 'X'; // Twitter is now X
    case LINKEDIN = 'LinkedIn';
    case YOUTUBE = 'YouTube';
    case FACEBOOK = 'Facebook';

    /**
     * Get the fully qualified class name of the validator for this platform.
     *
     * @return string
     */
    public function getValidatorClass(): string
    {
        return match ($this) {
            self::INSTAGRAM => 'AndreInocenti\SocialMediaUrlValidator\Platforms\InstagramValidator',
            self::TIKTOK => 'AndreInocenti\SocialMediaUrlValidator\Platforms\TikTokValidator',
            self::X => 'AndreInocenti\SocialMediaUrlValidator\Platforms\XValidator',
            self::LINKEDIN => 'AndreInocenti\SocialMediaUrlValidator\Platforms\LinkedInValidator',
            self::YOUTUBE => 'AndreInocenti\SocialMediaUrlValidator\Platforms\YouTubeValidator',
            self::FACEBOOK => 'AndreInocenti\SocialMediaUrlValidator\Platforms\FacebookValidator',
        };
    }

    /**
     * Get the enum instance by the short class name of the validator.
     *
     * @param string $shortClassName - Short class name of the validator (e.g., 'InstagramValidator')
     * @return PlatformsEnum
     */
    static function getByShortValidatorClass(string $shortClassName): PlatformsEnum
    {
        return match ($shortClassName) {
            'InstagramValidator' => self::INSTAGRAM,
            'TikTokValidator' => self::TIKTOK,
            'XValidator' => self::X,
            'LinkedInValidator' => self::LINKEDIN,
            'YouTubeValidator' => self::YOUTUBE,
            'FacebookValidator' => self::FACEBOOK,
        };
    }
}