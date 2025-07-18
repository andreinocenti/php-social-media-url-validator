<?php

use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;
use AndreInocenti\SocialMediaUrlValidator\Platforms\FacebookValidator;

it('matches facebook profile, page and post urls', function () {
    $v = new FacebookValidator;
    expect($v->matches('https://facebook.com/profile.php?id=1234'))->toBeTrue();
    expect($v->matches('https://facebook.com/PageName'))->toBeTrue();
    expect($v->matches('https://facebook.com/PageName/posts/5678'))->toBeTrue();
});

it('does not match non-facebook urls', function () {
    expect((new FacebookValidator)->matches('https://linkedin.com'))->toBeFalse();
});

it('detects facebook categories correctly', function () {
    $v = new FacebookValidator;
    expect($v->detectUrlCategory('https://facebook.com/profile.php?id=1234'))->toBe('profile');
    expect($v->detectUrlCategory('https://facebook.com/PageName'))->toBe('profile');
    expect($v->detectUrlCategory('https://facebook.com/PageName/posts/5678'))->toBe('post');
    expect($v->detectUrlCategory('https://facebook.com/PageName/about'))->toBeNull();
});

it('many facebook tests at once', function () {
    $url = [
        ['https://www.facebook.com/Example.Page',  PlatformsCategoriesEnum::PROFILE],
        ['https://facebook.com/profile.php?id=123456789', PlatformsCategoriesEnum::PROFILE],
        ['https://m.facebook.com/ExamplePage/posts/987654321', PlatformsCategoriesEnum::POST],
        ['https://facebook.com/story.php?story_fbid=555666777&id=123', PlatformsCategoriesEnum::POST],
        ['https://fb.watch/abcDEF123', PlatformsCategoriesEnum::VIDEO],
    ];

    $v = new FacebookValidator;
    foreach ($url as $u) {
        expect($v->matches($u[0]))->toBeTrue();
        expect($v->detectUrlCategory($u[0]))->toBe($u[1]->value);
    }
});
