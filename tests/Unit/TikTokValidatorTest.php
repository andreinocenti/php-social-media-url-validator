<?php

use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsEnum;
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

it('matches tiktok vm url', function () {
    $v = new TikTokValidator;
    expect($v->matches('https://vm.tiktok.com/AbCdEf/'))->toBeTrue();
});


it('many tiktok tests at once', function () {
    $url = [
        ['https://www.tiktok.com/@testdeusername/video/7525852090917195014/?test=test1',  PlatformsCategoriesEnum::VIDEO],
        ['https://www.tiktok.com/@tiktoker', PlatformsCategoriesEnum::PROFILE],
        ['https://tiktok.com/@user.name?test=123', PlatformsCategoriesEnum::PROFILE],
    ];

    $v = new TikTokValidator;
    foreach ($url as $u) {
        expect($v->matches($u[0]))->toBeTrue();
        expect($v->detectUrlCategory($u[0]))->toBe($u[1]->value);
    }
});
