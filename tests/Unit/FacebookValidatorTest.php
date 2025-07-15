<?php

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
    expect($v->detectUrlCategory('https://facebook.com/PageName'))->toBe('page');
    expect($v->detectUrlCategory('https://facebook.com/PageName/posts/5678'))->toBe('post');
    expect($v->detectUrlCategory('https://facebook.com/PageName/about'))->toBeNull();
});
