<?php

use AndreInocenti\SocialMediaUrlValidator\Platforms\XValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum as Cat;

beforeEach(function () {
    $this->v = new XValidator();
});

//
// DATASETS
//

dataset('x-valid-matches', [
    // Profiles
    'profile twitter'         => 'https://twitter.com/johndoe',
    'profile x'               => 'https://x.com/johndoe',
    'profile underscore'      => 'https://twitter.com/test_user',
    'profile digits'          => 'https://x.com/anotherUser123/',
    'profile with query'      => 'https://x.com/anotherUser123/?test=123',
    'profile mobile twitter'  => 'https://mobile.twitter.com/user',
    'profile mobile x'        => 'https://mobile.x.com/user',
    'profile www twitter'     => 'https://www.twitter.com/user',

    // Tweets (canonical)
    'status twitter'          => 'https://twitter.com/johndoe/status/123456',
    'status x trailing slash' => 'https://x.com/johndoe/status/123456/',
    'status with query'       => 'https://twitter.com/johndoe/status/123456?s=20&t=abc',
    'statuses legacy'         => 'https://twitter.com/johndoe/statuses/1234567890',

    // Tweets (i/web/status)
    'i web status twitter'    => 'https://twitter.com/i/web/status/998877665544',
    'i web status x'          => 'https://x.com/i/web/status/998877665544/?test=123',

    // Tweets (media subpaths)
    'status photo'            => 'https://twitter.com/johndoe/status/123456/photo/1',
    'status video'            => 'https://twitter.com/johndoe/status/123456/video/1',

    // Shortener (matches true; categoria null)
    't.co short'              => 'https://t.co/AbCdEfGhIj',
]);

dataset('x-negatives', [
    'non-twitter domain'      => 'https://example.com/johndoe',
    'explore'                 => 'https://twitter.com/explore',
    'hashtag'                 => 'https://twitter.com/hashtag/AI',
    'notifications'           => 'https://twitter.com/notifications',
    'home'                    => 'https://twitter.com/home',
    'search'                  => 'https://twitter.com/search?q=test',
    't.co root'               => 'https://t.co/',
]);

dataset('x-categories', [
    // PROFILE
    ['https://twitter.com/test_user',                         Cat::PROFILE],
    ['https://x.com/anotherUser123/',                         Cat::PROFILE],
    ['https://x.com/anotherUser123/?test=123',                Cat::PROFILE],
    ['https://mobile.twitter.com/user',                       Cat::PROFILE],
    ['https://mobile.x.com/user',                             Cat::PROFILE],

    // POST (tweets)
    ['https://x.com/nomeDoUser/status/1946027890505584777',   Cat::POST],
    ['https://mobile.twitter.com/user/status/112233445566',    Cat::POST],
    ['https://mobile.x.com/user/status/112233445566',          Cat::POST],
    ['https://twitter.com/i/web/status/998877665544',          Cat::POST],
    ['https://x.com/i/web/status/998877665544/',               Cat::POST],
    ['https://x.com/i/web/status/998877665544/?test=123',      Cat::POST],
    ['https://twitter.com/johndoe/status/123456?s=20',         Cat::POST],
    ['https://twitter.com/johndoe/statuses/1234567890',        Cat::POST],
    ['https://twitter.com/johndoe/status/123456/photo/1',      Cat::POST],
    ['https://twitter.com/johndoe/status/123456/video/1',      Cat::POST],

    // t.co shortener → sem categoria
    ['https://t.co/AbCdEfGhIj',                                null],
]);

//
// TESTES
//

describe('X - Twitter', function () {
    test('matches() aprova URLs válidas de X/Twitter', function (string $url) {
        expect($this->v->matches($url))->toBeTrue();
    })->with('x-valid-matches');

    test('matches() reprova URLs inválidas/fora do escopo', function (string $url) {
        expect($this->v->matches($url))->toBeFalse();
    })->with('x-negatives');

    test('detectUrlCategory() classifica corretamente perfis e tweets', function (string $url, $expected) {
        $got = $this->v->detectUrlCategory($url);
        $expected === null
            ? expect($got)->toBeNull()
            : expect($got)->toBe($expected->value);
    })->with('x-categories');

    // Mix no seu estilo original (expanded)
    it('many X tests at once (expanded)', function () {
        $rows = [
            ['https://twitter.com/test_user',                         Cat::PROFILE],
            ['https://x.com/anotherUser123/',                         Cat::PROFILE],
            ['https://x.com/anotherUser123/?test=123',                Cat::PROFILE],
            ['https://x.com/nomeDoUser/status/1946027890505584777',   Cat::POST],
            ['https://mobile.twitter.com/user/status/112233445566',    Cat::POST],
            ['https://mobile.x.com/user/status/112233445566',          Cat::POST],
            ['https://twitter.com/i/web/status/998877665544',          Cat::POST],
            ['https://x.com/i/web/status/998877665544/',               Cat::POST],
            ['https://x.com/i/web/status/998877665544/?test=123',      Cat::POST],
            ['https://t.co/AbCdEfGhIj',                                null], // categoria desconhecida
        ];

        $v = new XValidator;
        foreach ($rows as [$u, $expected]) {
            expect($v->matches($u))->toBeTrue();
            if ($expected === null) {
                expect($v->detectUrlCategory($u))->toBeNull();
            } else {
                expect($v->detectUrlCategory($u))->toBe($expected->value);
            }
        }
    });
});
