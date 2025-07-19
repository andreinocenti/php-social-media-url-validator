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
        ['https://www.facebook.com/story.php?story_fbid=1057786096151501&id=100057603602454&_rdr', PlatformsCategoriesEnum::POST],
        ['https://www.facebook.com/100044573043313/posts/1202953741200383/', PlatformsCategoriesEnum::POST],
        ['https://www.facebook.com/livealok/posts/pfbid02hZiXMYmzApzCTyPtPdFJcjNoLctb4UjjQ4ZWNRmC1jyWBwpGdAEmnpRQYWZgtftrl?rdid=EDuUBbnFKGvqROQx#', PlatformsCategoriesEnum::POST],
        ['https://www.facebook.com/story.php?story_fbid=1057786096151501&id=100057603602454&_rdr', PlatformsCategoriesEnum::POST],
        ['https://www.facebook.com/491794399620983/posts/1121416323325451', PlatformsCategoriesEnum::POST],
        ['https://www.facebook.com/REVISTABOOKINGR/posts/pfbid0AzwwUU8puAowPPuwxg6RqSbj44kFTT3STZsFwJof6DbBbRis79s6kxes13J5HYnWl', PlatformsCategoriesEnum::POST],
    ];

    $v = new FacebookValidator;
    foreach ($url as $u) {
        expect($v->matches($u[0]))->toBeTrue();
        expect($v->detectUrlCategory($u[0]))->toBe($u[1]->value);
    }
});
