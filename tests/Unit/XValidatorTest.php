<?php

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
