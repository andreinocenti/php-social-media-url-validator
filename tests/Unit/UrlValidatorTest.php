<?php

use AndreInocenti\SocialMediaUrlValidator\UrlValidator;

beforeEach(fn() => $validator = new UrlValidator());

it('detects platform by isX methods', function () {
    $v = new UrlValidator;
    expect($v->isInstagram('https://instagram.com/p/ID'))->toBeTrue();
    expect($v->isTwitter('https://twitter.com/user'))->toBeTrue();
    expect($v->isX('https://x.com/user'))->toBeTrue();
    expect($v->isFacebook('https://facebook.com/Page'))->toBeTrue();
    expect($v->isLinkedIn('https://linkedin.com/in/user'))->toBeTrue();
    expect($v->isTikTok('https://tiktok.com/@user'))->toBeTrue();
    expect($v->isYouTube('https://youtube.com/watch?v=abc'))->toBeTrue();
    expect($v->isInstagram('https://example.com'))->toBeFalse();
});

it('detects platform name via detectSocialMedia', function () {
    $v = new UrlValidator;
    expect($v->detectSocialMedia('https://instagram.com/p/ID'))->toBe('Instagram');
    expect($v->detectSocialMedia('https://twitter.com/user/status/1'))->toBe('X');
    expect($v->detectSocialMedia('https://x.com/user/status/1'))->toBe('X');
    expect($v->detectSocialMedia('https://facebook.com/profile.php?id=1'))->toBe('Facebook');
    expect($v->detectSocialMedia('https://linkedin.com/company/acme'))->toBe('LinkedIn');
    expect($v->detectSocialMedia('https://tiktok.com/@user/video/1'))->toBe('Tiktok');
    expect($v->detectSocialMedia('https://youtube.com/shorts/1'))->toBe('Youtube');
    expect($v->detectSocialMedia('https://unknown.com'))->toBeNull();
});

it('detects category by instagramCategory etc.', function () {
    $v = new UrlValidator;

    expect($v->instagramCategory('https://instagram.com/username/'))->toBe('profile');
    expect($v->twitterCategory('https://twitter.com/user/status/1'))->toBe('post');
    expect($v->twitterCategory('https://x.com/user/status/1'))->toBe('post');
    expect($v->facebookCategory('https://facebook.com/Page/posts/2'))->toBe('post');
    expect($v->linkedInCategory('https://linkedin.com/feed/update/urn:li:activity:123'))->toBe('post');
    expect($v->tiktokCategory('https://tiktok.com/@user'))->toBe('profile');
    expect($v->youTubeCategory('https://youtube.com/watch?v=vid'))->toBe('video');
});

it('detects generic category via detectSocialMediaCategory', function () {
    $v = new UrlValidator;
    expect($v->detectSocialMediaCategory('https://instagram.com/p/ID'))->toBe('post');
    expect($v->detectSocialMediaCategory('https://twitter.com/user'))->toBe('profile');
    expect($v->detectSocialMediaCategory('https://x.com/user'))->toBe('profile');
    expect($v->detectSocialMediaCategory('https://facebook.com/Page'))->toBe('profile');
    expect($v->detectSocialMediaCategory('https://linkedin.com/in/user'))->toBe('profile');
    expect($v->detectSocialMediaCategory('https://tiktok.com/@user/video/1'))->toBe('video');
    expect($v->detectSocialMediaCategory('https://unknown.com'))->toBeNull();
});
