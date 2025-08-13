<?php

use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;
use AndreInocenti\SocialMediaUrlValidator\Platforms\LinkedInValidator;

beforeEach(function () {
    $this->validator = new LinkedInValidator();
});

dataset('many-linkedin-urls', [
    ["https://www.linkedin.com/school/startse/", PlatformsCategoriesEnum::COMPANY],
    ["https://www.linkedin.com/company/revista-h&c/",PlatformsCategoriesEnum::COMPANY],
    ["https://www.linkedin.com/company/o-hall-&-spotlight-research/about/",PlatformsCategoriesEnum::COMPANY],
    ["https://br.linkedin.com/in/the-capital-advisor-b08302182",PlatformsCategoriesEnum::PROFILE],
    ["https://br.linkedin.com/in/andre-felicissimo-8033a8",PlatformsCategoriesEnum::PROFILE],
    ["https://br.linkedin.com/in/marjorieteixeira",PlatformsCategoriesEnum::PROFILE],
    ["https://br.linkedin.com/in/isabella-zakzuk-a3a63513",PlatformsCategoriesEnum::PROFILE],
    ["https://br.linkedin.com/in/luishsiqueira",PlatformsCategoriesEnum::PROFILE],
    ["https://br.linkedin.com/in/lauravicentini",PlatformsCategoriesEnum::PROFILE],
    ["https://www.linkedin.com/company/77194872/admin/",PlatformsCategoriesEnum::COMPANY],
    ["https://br.linkedin.com/in/andrea-velame-9564731ab",PlatformsCategoriesEnum::PROFILE],
    ["https://br.linkedin.com/in/v%C3%A2nia-goy-197b0891",PlatformsCategoriesEnum::PROFILE],
    ["https://www.linkedin.com/school/30752/",PlatformsCategoriesEnum::COMPANY],
    ["https://br.linkedin.com/in/ana-claudia-thorpe-87176224",PlatformsCategoriesEnum::PROFILE],
    ["https://br.linkedin.com/in/armindoferreira/pt",PlatformsCategoriesEnum::PROFILE],
    ["https://br.linkedin.com/in/orlando-tambosi-057a6a1a",PlatformsCategoriesEnum::PROFILE],
    ["https://br.linkedin.com/in/paulo-roberto-cardoso-945548125",PlatformsCategoriesEnum::PROFILE],
    ["https://br.linkedin.com/in/marcos-pedlowski-b7b68332",PlatformsCategoriesEnum::PROFILE],
    ["https://br.linkedin.com/in/rafael-porcari-17110938",PlatformsCategoriesEnum::PROFILE],
    ["https://br.linkedin.com/in/gustavo-negreiros-0443a956",PlatformsCategoriesEnum::PROFILE],
    ["https://br.linkedin.com/in/k%C3%A1tya-elpydio-228b706a",PlatformsCategoriesEnum::PROFILE],
    ["https://www.linkedin.com/company/10257971/admin/",PlatformsCategoriesEnum::COMPANY],
    ["https://br.linkedin.com/in/coluna-supinando-%F0%9F%A6%85%F0%9F%87%A7%F0%9F%87%B7-6109531a9",PlatformsCategoriesEnum::PROFILE],
    ["https://br.linkedin.com/in/fala-petrolina-aba89616b",PlatformsCategoriesEnum::PROFILE],
    ["https://www.linkedin.com/school/fm2s/",PlatformsCategoriesEnum::COMPANY],
    ["https://www.linkedin.com/groups/4550987/",PlatformsCategoriesEnum::GROUP],
    ["https://www.linkedin.com/groups/1827058/",PlatformsCategoriesEnum::GROUP],
    ["https://br.linkedin.com/in/paranashop-comunica%C3%A7%C3%A3o-25562a10a",PlatformsCategoriesEnum::PROFILE],
    ["https://br.linkedin.com/in/marianagabellini",PlatformsCategoriesEnum::PROFILE],
    ["https://www.linkedin.com/groups/8428248/",PlatformsCategoriesEnum::GROUP],
    ["https://www.linkedin.com/groups/4862591/",PlatformsCategoriesEnum::GROUP],
    ["https://www.linkedin.com/company/abecip---assoc.-bras-das-ent.-de-cr%CC%A9d.-imob.-e-pou/",PlatformsCategoriesEnum::COMPANY],
    ["https://www.linkedin.com/company/catve.com/about/",PlatformsCategoriesEnum::COMPANY],
    ["https://www.linkedin.com/groups/1883143/",PlatformsCategoriesEnum::GROUP],
    ["https://www.linkedin.com/groups/4862591/",PlatformsCategoriesEnum::GROUP],
    ["https://www.linkedin.com/company/oxarope.com/about/",PlatformsCategoriesEnum::COMPANY],
    ["https://www.linkedin.com/company/9303866/admin/",PlatformsCategoriesEnum::COMPANY],
    ["https://www.linkedin.com/school/unit-br/",PlatformsCategoriesEnum::COMPANY],
    ["https://www.linkedin.com/school/uniforoficial/",PlatformsCategoriesEnum::COMPANY],
    ["https://www.linkedin.com/school/ufscar/",PlatformsCategoriesEnum::COMPANY],
    ["https://www.linkedin.com/company/what's-rel-/",PlatformsCategoriesEnum::COMPANY],
    ["https://www.linkedin.com/groups/3992335/",PlatformsCategoriesEnum::GROUP],
    ["https://www.linkedin.com/company/zacks-research-pvt.-ltd/",PlatformsCategoriesEnum::COMPANY],
    ["https://br.linkedin.com/in/wwwzeduducombr",PlatformsCategoriesEnum::PROFILE],
    ["https://pt.linkedin.com/company/abdi.digital",PlatformsCategoriesEnum::COMPANY],
    ["https://www.linkedin.com/company/pais&filhos/",PlatformsCategoriesEnum::COMPANY],
    ["https://www.linkedin.com/showcase/4815222/admin/updates/",PlatformsCategoriesEnum::COMPANY],
    ["https://www.linkedin.com/company/abdi.digital/",PlatformsCategoriesEnum::COMPANY],
    ["https://www.linkedin.com/school/universidade-de-s-o-paulo",PlatformsCategoriesEnum::COMPANY],
    ["https://br.linkedin.com/in/katia-velo-3727476a/de",PlatformsCategoriesEnum::PROFILE],
    ["https://br.linkedin.com/in/tratamentodeagua",PlatformsCategoriesEnum::PROFILE],
]);

describe('LinkedIn', function () {
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
        expect($v->detectUrlCategory('https://linkedin.com/school/xyz'))->toBe('company');
    });


    it('many linkedin tests at once', function () {
        $url = [
            ['https://www.linkedin.com/in/alessandra-feij%C3%B3-8302652b/',  PlatformsCategoriesEnum::PROFILE],
            ['https://linkedin.com/in/public-user-123?test=123', PlatformsCategoriesEnum::PROFILE],
            ['https://lnkd.in/xyzABC', PlatformsCategoriesEnum::PROFILE],
            ['https://linkedin.com/company/examplecorp/', PlatformsCategoriesEnum::COMPANY],
            ['https://www.linkedin.com/company/kakaka/about/', PlatformsCategoriesEnum::COMPANY],
            ['https://www.linkedin.com/feed/update/urn:li:activity:1234567890123456789', PlatformsCategoriesEnum::POST],
            ['https://linkedin.com/posts/example-user-123_postIdXYZ', PlatformsCategoriesEnum::POST],
            ['https://www.linkedin.com/feed/update/urn:li:activity:1234567890123456789/?test=123', PlatformsCategoriesEnum::POST],
            ['https://www.linkedin.com/company/up-comunicação-inteligente/', PlatformsCategoriesEnum::COMPANY],
            ['https://www.linkedin.com/showcase/revistapegn/', PlatformsCategoriesEnum::COMPANY],
        ];

        $v = new LinkedInValidator;
        foreach ($url as $u) {
            expect($v->matches($u[0]))->toBeTrue();
            expect($v->detectUrlCategory($u[0]))->toBe($u[1]->value);
        }
    });

    /** Matches */

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

    /** detectUrlCategory */

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

    it('matches linkedin URLs', function ($url, $cat) {
        expect($this->validator->matches($url))->toBeTrue();
        expect($this->validator->detectUrlCategory($url))->toBe($cat->value);
    })->with('many-linkedin-urls');
});

