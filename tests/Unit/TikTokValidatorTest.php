<?php

use AndreInocenti\SocialMediaUrlValidator\Platforms\TikTokValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum as Cat;

beforeEach(function () {
    $this->v = new TikTokValidator();
});

//
// DATASETS
//

dataset('tt-valid-matches', [
    // PROFILE
    'profile basic'               => 'https://www.tiktok.com/@user',
    'profile trailing slash'      => 'https://www.tiktok.com/@user/',
    'profile query'               => 'https://www.tiktok.com/@user?lang=en',
    'profile dot'                 => 'https://tiktok.com/@user.name',
    'profile underscore'          => 'https://tiktok.com/@user_name',
    'profile digits'              => 'https://tiktok.com/@user123',
    'profile mobile'              => 'https://m.tiktok.com/@user',

    // VIDEO canonical
    'video basic'                 => 'https://www.tiktok.com/@user/video/7525852090917195014',
    'video trailing slash'        => 'https://www.tiktok.com/@user/video/7525852090917195014/',
    'video query'                 => 'https://www.tiktok.com/@user/video/7525852090917195014?is_copy_url=1&is_from_webapp=v1',
    'video query+frag'            => 'https://www.tiktok.com/@user/video/7525852090917195014/?utm=1#c',

    // VIDEO short links & mobile legacy
    'vm short'                    => 'https://vm.tiktok.com/ZMabcdefg/',
    'vt short'                    => 'https://vt.tiktok.com/ZMabcdefg/',
    't short'                     => 'https://www.tiktok.com/t/ZMabcdefg/',
    'mobile legacy v'             => 'https://m.tiktok.com/v/7525852090917195014',

    // VIDEO embed
    'embed v1'                    => 'https://www.tiktok.com/embed/7525852090917195014',
    'embed v2'                    => 'https://www.tiktok.com/embed/v2/7525852090917195014',
]);

dataset('tt-negatives', [
    // domínio errado
    'not tiktok'                  => 'https://example.com/video/123',
    // paths incompletos
    'video missing id'            => 'https://www.tiktok.com/@user/video/',
    'profile missing username'    => 'https://www.tiktok.com/@/',
    // rotas que não são conteúdo
    'followers'                   => 'https://www.tiktok.com/@user/followers',
    'tag'                         => 'https://www.tiktok.com/tag/cats',
    'music'                       => 'https://www.tiktok.com/music/some-track-123',
    'explore'                     => 'https://www.tiktok.com/explore',
]);

dataset('tt-categories', [
    // PROFILE
    ['https://www.tiktok.com/@tiktoker',                                      Cat::PROFILE],
    ['https://tiktok.com/@user.name?test=123',                                 Cat::PROFILE],
    ['https://m.tiktok.com/@user_123/',                                        Cat::PROFILE],

    // VIDEO (canonical)
    ['https://www.tiktok.com/@user/video/7525852090917195014',                 Cat::VIDEO],
    ['https://www.tiktok.com/@user/video/7525852090917195014/?x=1#f',          Cat::VIDEO],

    // VIDEO (short links & mobile legacy)
    ['https://vm.tiktok.com/ZMabcdefg/',                                       Cat::VIDEO],
    ['https://vt.tiktok.com/ZMabcdefg/',                                       Cat::VIDEO],
    ['https://www.tiktok.com/t/ZMabcdefg/',                                    Cat::VIDEO],
    ['https://m.tiktok.com/v/7525852090917195014',                             Cat::VIDEO],

    // VIDEO (embed)
    ['https://www.tiktok.com/embed/7525852090917195014',                       Cat::VIDEO],
    ['https://www.tiktok.com/embed/v2/7525852090917195014?lang=en',            Cat::VIDEO],

    // NULL (rotas não suportadas)
    // (matches pode ser true/false conforme sua policy; aqui só checamos categoria)
    ['https://www.tiktok.com/@user/followers',                                 null],
    ['https://www.tiktok.com/tag/cats',                                        null],
]);

//
// TESTES
//

describe('TikTok', function () {

    it('matches tiktok profile and video urls (expanded)', function (string $url) {
        expect($this->v->matches($url))->toBeTrue();
    })->with('tt-valid-matches');

    it('does not match non-tiktok or unsupported tiktok paths', function (string $url) {
        expect($this->v->matches($url))->toBeFalse();
    })->with('tt-negatives');

    it('detects tiktok categories correctly (expanded)', function (string $url, $expected) {
        if ($expected === null) {
            expect($this->v->detectUrlCategory($url))->toBeNull();
        } else {
            expect($this->v->detectUrlCategory($url))->toBe($expected->value);
        }
    })->with('tt-categories');

    // Mix compacto (mantendo seu estilo original)
    it('many tiktok tests at once (expanded)', function () {
        $rows = [
            ['https://www.tiktok.com/@testdeusername/video/7525852090917195014/?test=test1',  Cat::VIDEO],
            ['https://www.tiktok.com/@tiktoker',                                              Cat::PROFILE],
            ['https://tiktok.com/@user.name?test=123',                                        Cat::PROFILE],
            ['https://vm.tiktok.com/ZMabcdefg/',                                              Cat::VIDEO],
            ['https://www.tiktok.com/t/ZMabcdefg/',                                           Cat::VIDEO],
            ['https://www.tiktok.com/embed/7525852090917195014',                              Cat::VIDEO],
        ];

        $v = new TikTokValidator;
        foreach ($rows as [$u, $expected]) {
            expect($v->matches($u))->toBeTrue();
            expect($v->detectUrlCategory($u))->toBe($expected->value);
        }
    });
});