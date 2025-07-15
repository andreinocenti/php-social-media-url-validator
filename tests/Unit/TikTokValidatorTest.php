<?php

use AndreInocenti\SocialMediaUrlValidator\Platforms\TikTokValidator;

it('matches tiktok profile and video urls', function () {
    $v = new TikTokValidator;
    expect($v->matches('https://www.tiktok.com/@user'))->toBeTrue();
    expect($v->matches('https://www.tiktok.com/@user/video/9999'))->toBeTrue();
});

it('does not match non-tiktok urls', function () {
    expect((new TikTokValidator)->matches('https://example.com/video'))->toBeFalse();
});

it('detects tiktok categories correctly', function () {
    $v = new TikTokValidator;
    expect($v->detectUrlCategory('https://www.tiktok.com/@user'))->toBe('profile');
    expect($v->detectUrlCategory('https://www.tiktok.com/@user/video/9999'))->toBe('video');
    expect($v->detectUrlCategory('https://www.tiktok.com/@user/followers'))->toBeNull();
});
