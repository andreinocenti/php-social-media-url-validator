<?php
use AndreInocenti\SocialMediaUrlValidator\Platforms\InstagramValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum as Cat;

beforeEach(function () {
    $this->v = new InstagramValidator();
});

//
// Datasets
//

dataset('ig-valid-matches', [
    // POST (/p/)
    'post basic'             => 'https://www.instagram.com/p/ABC123xyz/',
    'post http'              => 'http://instagram.com/p/XYZ/',
    'post no trailing slash' => 'https://instagram.com/p/ABC123xyz',
    'post with query'        => 'https://instagram.com/p/ABC123xyz/?__a=1',
    'post with fragment'     => 'https://instagram.com/p/ABC123xyz/#comments',

    // REEL (/reel/)
    'reel basic'             => 'https://instagram.com/reel/REEL_4567/',
    'reel no trailing slash' => 'https://www.instagram.com/reel/REEL_4567',
    'reel with query'        => 'https://www.instagram.com/reel/REEL_4567/?utm_source=ig_web_copy_link',

    // IGTV (/tv/)
    'igtv basic'             => 'https://instagram.com/tv/IGTV_7890/',
    'igtv no trailing slash' => 'https://instagram.com/tv/IGTV_7890',
    'igtv with query'        => 'https://www.instagram.com/tv/IGTV_7890/?utm_source=feed',

    // PROFILE (/username)
    'profile basic'          => 'https://instagram.com/username/',
    'profile no trailing'    => 'https://instagram.com/username',
    'profile with query'     => 'https://www.instagram.com/jane.doe?hl=en',
    'profile underscore'     => 'https://www.instagram.com/john_doe/',
    'profile digits'         => 'https://instagram.com/user123',
    'profile http'           => 'http://www.instagram.com/johndoe',
    'profile case-ins host'  => 'HTTPS://INSTAGRAM.COM/johndoe/',
]);

dataset('ig-negatives', [
    // domínios errados
    'x.com'                  => 'https://x.com/instagram/status/1',
    // paths incompletos (faltando ID)
    'post missing id'        => 'https://instagram.com/p/',
    'reel missing id'        => 'https://www.instagram.com/reel/',
    'tv missing id'          => 'https://instagram.com/tv/',
    // rotas reservadas que não são conteúdos
    'accounts login'         => 'https://www.instagram.com/accounts/login/',
    'explore'                => 'https://www.instagram.com/explore/',
    'about'                  => 'https://www.instagram.com/about/',
]);

dataset('ig-categories', [
    // PROFILE
    ['https://instagram.com/username/',                              Cat::PROFILE],
    ['https://instagram.com/jane.doe',                               Cat::PROFILE],
    ['https://www.instagram.com/john_doe/?utm_source=x',             Cat::PROFILE],
    ['https://instagram.com/user123',                                 Cat::PROFILE],

    // POST
    ['https://instagram.com/p/POSTID/',                               Cat::POST],
    ['https://instagram.com/p/POST_ID-123',                           Cat::POST],
    ['https://www.instagram.com/p/ABC123_XY/?__a=1#c',                Cat::POST],

    // REEL
    ['https://instagram.com/reel/REEL4567',                           Cat::REEL],
    ['https://www.instagram.com/reel/REEL4567/?test=123',             Cat::REEL],

    // IGTV (legado)
    ['https://www.instagram.com/tv/VIDEOID/',                         Cat::IGTV],
    ['https://instagram.com/tv/VIDEO_ID-1?src=feed',                  Cat::IGTV],

    // DESCONHECIDO
    // (não validar categoria; o matches pode ser true/false dependendo da tua policy)
]);

describe("Instagram", function () {
    //
    // matches()
    //

    test('matches() approves valid Instagram URLs', function (string $url) {
        expect($this->v->matches($url))->toBeTrue();
    })->with('ig-valid-matches');

    test('matches() reproves invalid and out of context URLs', function (string $url) {
        expect($this->v->matches($url))->toBeFalse();
    })->with('ig-negatives');

    //
    // detectUrlCategory()
    //

    test('detectUrlCategory() classifies correctly', function (string $url, Cat $expected) {
        // se sua policy exige, você pode também garantir matches() === true aqui
        expect($this->v->detectUrlCategory($url))->toBe($expected->value);
    })->with('ig-categories');

    //
    // Casos agregados (mix), incluindo sufixos variados
    //

    it('many instagram tests at once (expanded)', function () {
        $rows = [
            ['https://www.instagram.com/johndoe?test=123',                Cat::PROFILE],
            ['https://instagram.com/jane.doe',                            Cat::PROFILE],
            ['https://instagram.com/john_doe/',                           Cat::PROFILE],
            ['https://instagram.com/p/ABC123_XY',                         Cat::POST],
            ['https://www.instagram.com/p/ABC123_XY/?test=123',           Cat::POST],
            ['https://instagram.com/reel/REEL4567#frag',                  Cat::REEL],
            ['https://www.instagram.com/tv/IGTV_7890/?utm_source=feed',   Cat::IGTV],
        ];

        foreach ($rows as [$u, $expected]) {
            expect($this->v->matches($u))->toBeTrue();
            expect($this->v->detectUrlCategory($u))->toBe($expected->value);
        }
    });


    it('matches instagram post urls', function () {
        $v = new InstagramValidator;
        expect($v->matches('https://www.instagram.com/p/ABC123xyz/'))->toBeTrue();
        expect($v->matches('http://instagram.com/p/XYZ/'))->toBeTrue();
    });

    it('does not match non-instagram urls', function () {
        expect((new InstagramValidator)->matches('https://twitter.com/user/status/123'))->toBeFalse();
    });

    it('detects instagram categories correctly', function () {
        $v = new InstagramValidator;
        expect($v->detectUrlCategory('https://instagram.com/username/'))->toBe('profile');
        expect($v->detectUrlCategory('https://instagram.com/p/POSTID/'))->toBe('post');
        expect($v->detectUrlCategory('https://instagram.com/reel/REELID/'))->toBe('reel');
        expect($v->detectUrlCategory('https://instagram.com/tv/VIDEOID/'))->toBe('igtv');
        expect($v->detectUrlCategory('https://instagram.com/unknown/path'))->toBeNull();
    });
});