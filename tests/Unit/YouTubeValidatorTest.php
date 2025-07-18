<?php

use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;
use AndreInocenti\SocialMediaUrlValidator\Platforms\YouTubeValidator;

it('matches youtube channel, user, custom, video and shorts urls', function () {
    $v = new YouTubeValidator;
    expect($v->matches('https://www.youtube.com/channel/ABC'))->toBeTrue();
    expect($v->matches('https://youtu.be/channel/ABC'))->toBeTrue();
    expect($v->matches('https://youtube.com/user/johndoe'))->toBeTrue();
    expect($v->matches('http://youtube.com/c/CustomName'))->toBeTrue();
    expect($v->matches('https://www.youtube.com/watch?v=xyz123'))->toBeTrue();
    expect($v->matches('https://youtube.com/shorts/shortID'))->toBeTrue();
});

it('does not match non-youtube urls', function () {
    expect((new YouTubeValidator)->matches('https://vimeo.com/1234'))->toBeFalse();
});

it('detects youtube categories correctly', function () {
    $v = new YouTubeValidator;
    expect($v->detectUrlCategory('https://www.youtube.com/channel/ABC'))->toBe('channel');
    expect($v->detectUrlCategory('https://www.youtube.com/user/johndoe'))->toBe('user');
    expect($v->detectUrlCategory('https://www.youtube.com/watch?v=xyz123'))->toBe('video');
    expect($v->detectUrlCategory('https://www.youtube.com/shorts/shortID'))->toBe('shorts');
    expect($v->detectUrlCategory('https://www.youtube.com/playlist?list=PL'))->toBe('playlist');
});

it('many youtube tests at once', function () {
    $url = [
        ['https://www.youtube.com/watch?v=VIDEO12345',  PlatformsCategoriesEnum::VIDEO],
        ['https://www.youtube.com/watch?v=VIDEO12345&sad=123&osos=456',  PlatformsCategoriesEnum::VIDEO],
        ['https://youtu.be/SHORT67890',  PlatformsCategoriesEnum::VIDEO],
        ['https://youtube.com/shorts/SHORTID123',  PlatformsCategoriesEnum::SHORTS],
        ['https://www.youtube.com/channel/UCabcdefGHIJKLMN',  PlatformsCategoriesEnum::CHANNEL],
        ['https://www.youtube.com/channel/UCabcdefGHIJKLMN/?test=123',  PlatformsCategoriesEnum::CHANNEL],
        ['https://youtube.com/user/legacyUserName',  PlatformsCategoriesEnum::USER],
        ['https://www.youtube.com/c/CustomName123',  PlatformsCategoriesEnum::CUSTOM],
        ['https://www.youtube.com/playlist?list=PL1234567890',  PlatformsCategoriesEnum::PLAYLIST],
    ];

    $v = new YouTubeValidator;
    foreach ($url as $u) {
        expect($v->matches($u[0]))->toBeTrue();
        expect($v->detectUrlCategory($u[0]))->toBe($u[1]->value);
    }
});