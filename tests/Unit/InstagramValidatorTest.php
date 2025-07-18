<?php

use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;
use AndreInocenti\SocialMediaUrlValidator\Platforms\InstagramValidator;

it('matches instagram post urls', function () {
    $v = new InstagramValidator;
    expect($v->matches('https://www.instagram.com/p/ABC123xyz/'))->toBeTrue();
    expect($v->matches('http://instagram.com/p/XYZ/'))->toBeTrue();
});

it('does not match non-instagram urls', function () {
    expect((new InstagramValidator)->matches('https://twitter.com/user/status/123'))->toBeFalse();
});

it('detects instagram categories correctly', function () {
    $v = new InstagramValidator;
    expect($v->detectUrlCategory('https://instagram.com/username/'))->toBe('profile');
    expect($v->detectUrlCategory('https://instagram.com/p/POSTID/'))->toBe('post');
    expect($v->detectUrlCategory('https://instagram.com/reel/REELID/'))->toBe('reel');
    expect($v->detectUrlCategory('https://instagram.com/tv/VIDEOID/'))->toBe('igtv');
    expect($v->detectUrlCategory('https://instagram.com/unknown/path'))->toBeNull();
});

it('many instagram tests at once', function () {
    $url = [
        ['https://www.instagram.com/johndoe?test=123',  PlatformsCategoriesEnum::PROFILE],
        ['https://instagram.com/jane.doe', PlatformsCategoriesEnum::PROFILE],
        ['https://www.instagram.com/p/ABC123_XY', PlatformsCategoriesEnum::POST],
        ['https://www.instagram.com/p/ABC123_XY/?test=123', PlatformsCategoriesEnum::POST],
        ['https://instagram.com/reel/REEL4567', PlatformsCategoriesEnum::REEL],
        ['https://www.instagram.com/tv/IGTV_7890/?utm_source=feed', PlatformsCategoriesEnum::IGTV],
    ];

    $v = new InstagramValidator;
    foreach ($url as $u) {
        expect($v->matches($u[0]))->toBeTrue();
        expect($v->detectUrlCategory($u[0]))->toBe($u[1]->value);
    }
});