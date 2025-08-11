<?php

use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;
use AndreInocenti\SocialMediaUrlValidator\Platforms\FacebookValidator;

describe('Facebook', function () {
    //
    // matches()
    //

    it('matches diverse facebook URLs', function () {
        $v = new FacebookValidator;

        // Profile / Page
        expect($v->matches('https://facebook.com/profile.php?id=1234'))->toBeTrue();
        expect($v->matches('https://www.facebook.com/profile.php?id=1234&ref=bookmarks'))->toBeTrue();
        expect($v->matches('https://m.facebook.com/profile.php?id=1234/'))->toBeTrue();

        expect($v->matches('https://facebook.com/Page.Name'))->toBeTrue();
        expect($v->matches('https://www.facebook.com/PageName/'))->toBeTrue();
        expect($v->matches('https://m.facebook.com/PageName?utm_source=x'))->toBeTrue();

        // Posts (numérico e pfbid)
        expect($v->matches('https://facebook.com/PageName/posts/5678'))->toBeTrue();
        expect($v->matches('https://www.facebook.com/PageName/posts/pfbid02hZiXMYmzApzCTyPtPdFJcjNoLctb4UjjQ4ZWNRmC1jyWBwpGdAEmnpRQYWZgtftrl'))->toBeTrue();
        expect($v->matches('https://m.facebook.com/PageName/posts/987654321/?ref=share'))->toBeTrue();
        expect($v->matches('https://www.facebook.com/100044573043313/posts/1202953741200383/'))->toBeTrue();
        expect($v->matches('https://www.facebook.com/491794399620983/posts/1121416323325451'))->toBeTrue();

        // Story / Permalink
        expect($v->matches('https://facebook.com/story.php?story_fbid=555666777&id=123'))->toBeTrue();
        expect($v->matches('https://www.facebook.com/story.php?story_fbid=1057786096151501&id=100057603602454&_rdr'))->toBeTrue();
        expect($v->matches('https://www.facebook.com/story.php?story_fbid=1057786096151501&id=100057603602454&_rdr#/'))->toBeTrue();

        // Group post
        expect($v->matches('https://www.facebook.com/groups/123456789012345/posts/987654321098765'))->toBeTrue();

        // Vídeo
        expect($v->matches('https://www.facebook.com/PageName/videos/1234567890123456/'))->toBeTrue();
        expect($v->matches('https://m.facebook.com/video.php?v=9876543210'))->toBeTrue();
        expect($v->matches('https://www.facebook.com/watch/?v=123456789012345'))->toBeTrue(); // Facebook Watch
        expect($v->matches('https://fb.watch/abcDEF123/'))->toBeTrue();

        // Reels (trataremos como vídeo nos categories)
        expect($v->matches('https://www.facebook.com/reel/1234567890123456/'))->toBeTrue();

        // Negativos
        expect($v->matches('https://linkedin.com'))->toBeFalse();
        expect($v->matches('https://www.facebook.com/PageName/about'))->toBeTrue();   // é do domínio, mas não é post/profile/video
    });

    //
    // detectUrlCategory()
    //

    it('detects facebook categories correctly (basic)', function () {
        $v = new FacebookValidator;
        expect($v->detectUrlCategory('https://facebook.com/profile.php?id=1234'))->toBe(PlatformsCategoriesEnum::PROFILE->value);
        expect($v->detectUrlCategory('https://facebook.com/PageName'))->toBe(PlatformsCategoriesEnum::PROFILE->value);
        expect($v->detectUrlCategory('https://facebook.com/PageName/posts/5678'))->toBe(PlatformsCategoriesEnum::POST->value);
        expect($v->detectUrlCategory('https://facebook.com/PageName/about'))->toBeNull();
    });

    it('detects POST in many shapes', function () {
        $v = new FacebookValidator;

        $posts = [
            'https://m.facebook.com/ExamplePage/posts/987654321',
            'https://facebook.com/story.php?story_fbid=555666777&id=123',
            'https://www.facebook.com/story.php?story_fbid=1057786096151501&id=100057603602454&_rdr',
            'https://www.facebook.com/100044573043313/posts/1202953741200383/',
            'https://www.facebook.com/491794399620983/posts/1121416323325451',
            'https://www.facebook.com/REVISTABOOKINGR/posts/pfbid0AzwwUU8puAowPPuwxg6RqSbj44kFTT3STZsFwJof6DbBbRis79s6kxes13J5HYnWl',
            // grupos
            'https://www.facebook.com/groups/123456789012345/posts/987654321098765',
            // pfbid com query e fragment
            'https://www.facebook.com/livealok/posts/pfbid02hZiXMYmzApzCTyPtPdFJcjNoLctb4UjjQ4ZWNRmC1jyWBwpGdAEmnpRQYWZgtftrl?rdid=EDuUBbnFKGvqROQx#',
        ];

        foreach ($posts as $url) {
            expect($v->detectUrlCategory($url))->toBe(PlatformsCategoriesEnum::POST->value);
        }
    });

    it('detects VIDEO variants (videos/, video.php, fb.watch, watch/?v=…, reel)', function () {
        $v = new FacebookValidator;

        $videos = [
            'https://www.facebook.com/PageName/videos/1234567890123456/',
            'https://m.facebook.com/video.php?v=9876543210',
            'https://fb.watch/abcDEF123',
            'https://www.facebook.com/watch/?v=123456789012345', // Facebook Watch
            'https://www.facebook.com/reel/1234567890123456/',   // considerar como VIDEO
        ];

        foreach ($videos as $url) {
            expect($v->detectUrlCategory($url))->toBe(PlatformsCategoriesEnum::VIDEO->value);
        }
    });

    it('detects PROFILE variants (vanity, profile.php, subdomain, query/trailing slash)', function () {
        $v = new FacebookValidator;

        $profiles = [
            'https://facebook.com/profile.php?id=1234',
            'https://www.facebook.com/profile.php?id=1234&ref=bookmarks',
            'https://m.facebook.com/profile.php?id=1234/',
            'https://facebook.com/Page.Name',
            'https://www.facebook.com/PageName/',
            'https://m.facebook.com/PageName?utm_source=x',
        ];

        foreach ($profiles as $url) {
            expect($v->detectUrlCategory($url))->toBe(PlatformsCategoriesEnum::PROFILE->value);
        }
    });

    it('many facebook tests at once (expanded)', function () {
        $url = [
            ['https://www.facebook.com/Example.Page',  PlatformsCategoriesEnum::PROFILE],
            ['https://facebook.com/profile.php?id=123456789', PlatformsCategoriesEnum::PROFILE],
            ['https://m.facebook.com/ExamplePage/posts/987654321', PlatformsCategoriesEnum::POST],
            ['https://facebook.com/story.php?story_fbid=555666777&id=123', PlatformsCategoriesEnum::POST],
            ['https://fb.watch/abcDEF123', PlatformsCategoriesEnum::VIDEO],
            ['https://www.facebook.com/story.php?story_fbid=1057786096151501&id=100057603602454&_rdr', PlatformsCategoriesEnum::POST],
            ['https://www.facebook.com/100044573043313/posts/1202953741200383/', PlatformsCategoriesEnum::POST],
            ['https://www.facebook.com/livealok/posts/pfbid02hZiXMYmzApzCTyPtPdFJcjNoLctb4UjjQ4ZWNRmC1jyWBwpGdAEmnpRQYWZgtftrl?rdid=EDuUBbnFKGvqROQx#', PlatformsCategoriesEnum::POST],
            ['https://www.facebook.com/491794399620983/posts/1121416323325451', PlatformsCategoriesEnum::POST],
            ['https://www.facebook.com/REVISTABOOKINGR/posts/pfbid0AzwwUU8puAowPPuwxg6RqSbj44kFTT3STZsFwJof6DbBbRis79s6kxes13J5HYnWl', PlatformsCategoriesEnum::POST],
            // extras
            ['https://www.facebook.com/PageName/videos/1234567890123456/', PlatformsCategoriesEnum::VIDEO],
            ['https://www.facebook.com/watch/?v=123456789012345', PlatformsCategoriesEnum::VIDEO],
            ['https://www.facebook.com/reel/1234567890123456/', PlatformsCategoriesEnum::VIDEO],
            ['https://www.facebook.com/groups/123456789012345/posts/987654321098765', PlatformsCategoriesEnum::POST],
        ];

        $v = new FacebookValidator;
        foreach ($url as $u) {
            expect($v->matches($u[0]))->toBeTrue();
            expect($v->detectUrlCategory($u[0]))->toBe($u[1]->value);
        }
    });
});
