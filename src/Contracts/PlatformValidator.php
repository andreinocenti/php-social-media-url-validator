<?php
namespace AndreInocenti\SocialMediaUrlValidator\Contracts;

interface PlatformValidator{
    /**
     * Return true if this URL belongs to the platform.
     */
    public function matches(string $url): bool;

    /**
     * Return a string describing the specific URL type (profile, post, video…)
     * or null if unknown.
     */
    public function detectUrlCategory(string $url): ?string;
}