<?php

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
