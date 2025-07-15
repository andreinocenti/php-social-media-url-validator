<?php

use AndreInocenti\SocialMediaUrlValidator\Platforms\LinkedInValidator;

it('matches linkedin profile, company and post urls', function () {
    $v = new LinkedInValidator;
    expect($v->matches('https://linkedin.com/in/username'))->toBeTrue();
    expect($v->matches('https://linkedin.com/company/acme'))->toBeTrue();
    expect($v->matches('https://linkedin.com/feed/update/urn:li:activity:12345'))->toBeTrue();
});

it('does not match non-linkedin urls', function () {
    expect((new LinkedInValidator)->matches('https://youtube.com/watch?v=abc'))->toBeFalse();
});

it('detects linkedin categories correctly', function () {
    $v = new LinkedInValidator;
    expect($v->detectUrlCategory('https://linkedin.com/in/username'))->toBe('profile');
    expect($v->detectUrlCategory('https://linkedin.com/company/acme'))->toBe('company');
    expect($v->detectUrlCategory('https://linkedin.com/feed/update/urn:li:activity:12345'))->toBe('post');
    expect($v->detectUrlCategory('https://linkedin.com/school/xyz'))->toBeNull();
});
