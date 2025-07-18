<?php

use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;
use AndreInocenti\SocialMediaUrlValidator\Platforms\XValidator;

it('matches twitter profile and tweet urls', function () {
    $v = new XValidator;
    expect($v->matches('https://twitter.com/johndoe'))->toBeTrue();
    expect($v->matches('https://twitter.com/johndoe/status/123456'))->toBeTrue();
    expect($v->matches('https://x.com/johndoe'))->toBeTrue();
    expect($v->matches('https://x.com/johndoe/status/123456'))->toBeTrue();
    expect($v->matches('https://t.co/johndoe'))->toBeTrue();
    expect($v->matches('https://t.co/johndoe/status/123456'))->toBeTrue();
});

it('does not match non-twitter urls', function () {
    expect((new XValidator)->matches('https://facebook.com'))->toBeFalse();
});

it('detects twitter categories correctly', function () {
    $v = new XValidator;
    expect($v->detectUrlCategory('https://twitter.com/johndoe'))->toBe('profile');
    expect($v->detectUrlCategory('https://x.com/johndoe'))->toBe('profile');
    expect($v->detectUrlCategory('https://twitter.com/johndoe/status/987654'))->toBe('post');
    expect($v->detectUrlCategory('https://x.com/johndoe/status/987654'))->toBe('post');
});


it('many X tests at once', function () {
    $url = [
        ['https://twitter.com/test_user',  PlatformsCategoriesEnum::PROFILE],
        ['https://x.com/anotherUser123/', PlatformsCategoriesEnum::PROFILE],
        ['https://x.com/anotherUser123/?test=123', PlatformsCategoriesEnum::PROFILE],
        ['https://x.com/nomeDoUser/status/1946027890505584777', PlatformsCategoriesEnum::POST],
        ['https://mobile.twitter.com/user/status/112233445566', PlatformsCategoriesEnum::POST],
        ['https://mobile.x.com/user/status/112233445566', PlatformsCategoriesEnum::POST],
        ['https://twitter.com/i/web/status/99887766554', PlatformsCategoriesEnum::POST],
        ['https://x.com/i/web/status/998877665544/', PlatformsCategoriesEnum::POST],
        ['https://x.com/i/web/status/998877665544/?test=123', PlatformsCategoriesEnum::POST],
    ];

    $v = new XValidator;
    foreach ($url as $u) {
        expect($v->matches($u[0]))->toBeTrue();
        expect($v->detectUrlCategory($u[0]))->toBe($u[1]->value);
    }
});