<?php

use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;
use AndreInocenti\SocialMediaUrlValidator\Platforms\LinkedInValidator;

beforeEach(function () {
    $this->validator = new LinkedInValidator();
});

it('matches linkedin profile, company and post urls', function () {
    $v = new LinkedInValidator;
    expect($v->matches('https://linkedin.com/in/username'))->toBeTrue();
    expect($v->matches('https://linkedin.com/company/acme'))->toBeTrue();
    expect($v->matches('https://linkedin.com/feed/update/urn:li:activity:12345'))->toBeTrue();
    expect($v->matches('https://www.linkedin.com/posts/jnjinnovativemedicinebrasil_avan%C3%A7os-no-tratamento-do-mieloma-m%C3%BAltiplo-activity-7349525945143197697-5YSU/?utm_source=social_share_send&utm_medium=member_desktop_web&rcm=ACoAAARdaMQBlO6dVjr8kIujY9JewzbT6sLqEdE'))->toBeTrue();
});

it('does not match non-linkedin urls', function () {
    expect((new LinkedInValidator)->matches('https://youtube.com/watch?v=abc'))->toBeFalse();
});

it('detects linkedin categories correctly', function () {
    $v = new LinkedInValidator;
    expect($v->detectUrlCategory('https://linkedin.com/in/username'))->toBe('profile');
    expect($v->detectUrlCategory('https://linkedin.com/company/acme'))->toBe('company');
    expect($v->detectUrlCategory('https://linkedin.com/feed/update/urn:li:activity:12345'))->toBe('post');
    expect($v->detectUrlCategory('https://www.linkedin.com/posts/jnjinnovativemedicinebrasil_avan%C3%A7os-no-tratamento-do-mieloma-m%C3%BAltiplo-activity-7349525945143197697-5YSU/?utm_source=social_share_send&utm_medium=member_desktop_web&rcm=ACoAAARdaMQBlO6dVjr8kIujY9JewzbT6sLqEdE'))->toBe('post');
    expect($v->detectUrlCategory('https://linkedin.com/school/xyz'))->toBeNull();
});


it('many linkedin tests at once', function () {
    $url = [
        ['https://www.linkedin.com/in/alessandra-feij%C3%B3-8302652b/',  PlatformsCategoriesEnum::PROFILE],
        ['https://linkedin.com/in/public-user-123?test=123', PlatformsCategoriesEnum::PROFILE],
        ['https://lnkd.in/xyzABC', PlatformsCategoriesEnum::PROFILE],
        ['https://linkedin.com/company/examplecorp/', PlatformsCategoriesEnum::COMPANY],
        ['https://www.linkedin.com/feed/update/urn:li:activity:1234567890123456789', PlatformsCategoriesEnum::POST],
        ['https://linkedin.com/posts/example-user-123_postIdXYZ', PlatformsCategoriesEnum::POST],
        ['https://www.linkedin.com/feed/update/urn:li:activity:1234567890123456789/?test=123', PlatformsCategoriesEnum::POST],
    ];

    $v = new LinkedInValidator;
    foreach ($url as $u) {
        expect($v->matches($u[0]))->toBeTrue();
        expect($v->detectUrlCategory($u[0]))->toBe($u[1]->value);
    }
});

//
// matches()
//

describe('LinkedInValidator::matches', function () {
    it('matches profile with percent-encoded chars', function () {
        $url = 'https://www.linkedin.com/in/alessandra-feij%C3%B3-8302652b/';
        expect($this->validator->matches($url))->toBeTrue();
    });

    it('matches profile on subdomain', function () {
        $url = 'https://br.linkedin.com/in/jos%C3%A9-silva-123abc/';
        expect($this->validator->matches($url))->toBeTrue();
    });

    it('matches posts with underscore-separated id (percent-encoded slug)', function () {
        $url = 'https://www.linkedin.com/posts/jnjinnovativemedicinebrasil_avan%C3%A7os-no-tratamento-do-mieloma-multiplo-activity-7349525945143197697-5YSU/';
        expect($this->validator->matches($url))->toBeTrue();
    });

    it('matches activity feed update', function () {
        $url = 'https://www.linkedin.com/feed/update/urn:li:activity:7349525945143197697';
        expect($this->validator->matches($url))->toBeTrue();
    });

    it('matches company page with query', function () {
        $url = 'https://www.linkedin.com/company/example-co/?trk=xyz';
        expect($this->validator->matches($url))->toBeTrue();
    });

    it('does not match non-linkedin domains', function () {
        $url = 'https://example.com/in/whatever';
        expect($this->validator->matches($url))->toBeFalse();
    });
});

//
// detectUrlCategory()
//

describe('LinkedInValidator::detectUrlCategory', function () {
    it('detects PROFILE (percent-encoded profile slug)', function () {
        $url = 'https://www.linkedin.com/in/alessandra-feij%C3%B3-8302652b/';
        expect($this->validator->detectUrlCategory($url))
            ->toBe(PlatformsCategoriesEnum::PROFILE->value);
    });

    it('detects PROFILE on subdomain with query', function () {
        $url = 'https://br.linkedin.com/in/jos%C3%A9-silva-123abc/?utm_source=x';
        expect($this->validator->detectUrlCategory($url))
            ->toBe(PlatformsCategoriesEnum::PROFILE->value);
    });

    it('detects PROFILE from lnkd.in short link', function () {
        $url = 'https://lnkd.in/abcDEF12';
        expect($this->validator->detectUrlCategory($url))
            ->toBe(PlatformsCategoriesEnum::PROFILE->value);
    });

    it('detects COMPANY', function () {
        $url = 'https://www.linkedin.com/company/example-co/?param=1';
        expect($this->validator->detectUrlCategory($url))
            ->toBe(PlatformsCategoriesEnum::COMPANY->value);
    });

    it('detects POST from /posts/ with percent-encoded slug', function () {
        $url = 'https://www.linkedin.com/posts/jnjinnovativemedicinebrasil_avan%C3%A7os-no-tratamento-do-mieloma-multiplo-activity-7349525945143197697-5YSU/?utm_source=social';
        expect($this->validator->detectUrlCategory($url))
            ->toBe(PlatformsCategoriesEnum::POST->value);
    });

    it('detects POST from feed activity', function () {
        $url = 'https://www.linkedin.com/feed/update/urn:li:activity:7349525945143197697';
        expect($this->validator->detectUrlCategory($url))
            ->toBe(PlatformsCategoriesEnum::POST->value);
    });

    it('returns null for unsupported LinkedIn paths', function () {
        $url = 'https://www.linkedin.com/help';
        expect($this->validator->detectUrlCategory($url))->toBeNull();
    });
});

