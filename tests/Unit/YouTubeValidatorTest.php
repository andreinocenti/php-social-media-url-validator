<?php

use AndreInocenti\SocialMediaUrlValidator\Platforms\YouTubeValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum as Cat;

beforeEach(function () {
    $this->v = new YouTubeValidator();
});

describe('YouTube', function () {

    //
    // MATCHES
    //

    dataset('yt-valid-matches', [
        // VIDEO (watch)
        'watch basic'                 => 'https://www.youtube.com/watch?v=VIDEO12345',
        'watch slash before query'    => 'https://www.youtube.com/watch/?v=VIDEO12345',
        'watch many params'           => 'https://www.youtube.com/watch?v=VIDEO12345&sad=123&osos=456',
        'watch with timestamp'        => 'https://www.youtube.com/watch?v=VIDEO12345&t=42s',
        'watch with list too'         => 'https://www.youtube.com/watch?v=VIDEO12345&list=PL123',

        // VIDEO (short youtu.be)
        'youtu.be basic'              => 'https://youtu.be/SHORT67890',
        'youtu.be trailing slash'     => 'https://youtu.be/SHORT67890/',
        'youtu.be with query'         => 'https://youtu.be/SHORT67890?si=abc123',

        // VIDEO (embed)
        'embed www'                   => 'https://www.youtube.com/embed/VIDEO12345',
        'embed nocookie'              => 'https://www.youtube-nocookie.com/embed/VIDEO12345?rel=0',

        // VIDEO (mobile)
        'watch mobile'                => 'https://m.youtube.com/watch?v=VIDEO12345',

        // SHORTS
        'shorts basic'                => 'https://youtube.com/shorts/SHORTID123',
        'shorts mobile'               => 'https://m.youtube.com/shorts/SHORTID123',

        // CHANNEL
        'channel id'                  => 'https://www.youtube.com/channel/UCabcdefGHIJKLMN',
        'channel id slash'            => 'https://www.youtube.com/channel/UCabcdefGHIJKLMN/',
        'channel id with query'       => 'https://www.youtube.com/channel/UCabcdefGHIJKLMN/?test=123',

        // HANDLE
        'handle root'                 => 'https://www.youtube.com/@MyClappy',
        'handle slash'                => 'https://www.youtube.com/@canaldigplay/',
        'handle subpage videos'       => 'https://www.youtube.com/@canaldigplay/videos',
        'handle subpage about'        => 'https://www.youtube.com/@canaldigplay/about?hl=pt-BR',

        // ROOT CUSTOM CHANNEL (ex.: /ancap_su)
        'root custom basic'           => 'https://www.youtube.com/ancap_su',
        'root custom subpage'         => 'https://www.youtube.com/ancap_su/streams?foo=bar',

        // USER legacy
        'user legacy'                 => 'https://youtube.com/user/legacyUserName',

        // CUSTOM (/c/)
        'custom /c/'                  => 'https://www.youtube.com/c/CustomName123',

        // PLAYLIST
        'playlist page'               => 'https://www.youtube.com/playlist?list=PL1234567890',
    ]);

    dataset('yt-negatives', [
        // domínios errados
        'not youtube'                 => 'https://vimeo.com/1234',
        'fake domain'                 => 'https://y0utube.com/watch?v=abc',
        // paths incompletos/não-conteúdo
        'watch missing id'            => 'https://www.youtube.com/watch?v=',
        'shorts missing id'           => 'https://www.youtube.com/shorts/',
        'embed missing id'            => 'https://www.youtube.com/embed/',
        'nocookie missing id'         => 'https://www.youtube-nocookie.com/embed/',
        // páginas reservadas (não conteúdo)
        'about site'                  => 'https://www.youtube.com/about',
        'feed subscriptions'          => 'https://www.youtube.com/feed/subscriptions',
        'results search'              => 'https://www.youtube.com/results?search_query=php',
        // youtu.be inválido
        'youtu.be root'               => 'https://youtu.be/',
    ]);

    //
    // CATEGORIES
    //

    dataset('yt-categories', [
        // VIDEO
        ['https://www.youtube.com/watch?v=VIDEO12345',                        Cat::VIDEO],
        ['https://www.youtube.com/watch/?v=VIDEO12345',                       Cat::VIDEO],
        ['https://www.youtube.com/watch?v=VIDEO12345&sad=123&osos=456',       Cat::VIDEO],
        ['https://youtu.be/SHORT67890',                                       Cat::VIDEO],
        ['https://youtu.be/SHORT67890/?test=123',                             Cat::VIDEO],
        ['https://www.youtube.com/embed/VIDEO12345',                          Cat::VIDEO],
        ['https://www.youtube-nocookie.com/embed/VIDEO12345?rel=0',           Cat::VIDEO],
        ['https://m.youtube.com/watch?v=VIDEO12345',                          Cat::VIDEO],
        // WATCH com list também deve ser VIDEO (e não PLAYLIST)
        ['https://www.youtube.com/watch?v=VIDEO12345&list=PL123456',          Cat::VIDEO],

        // SHORTS
        ['https://youtube.com/shorts/SHORTID123',                             Cat::SHORTS],
        ['https://m.youtube.com/shorts/SHORTID123',                           Cat::SHORTS],

        // CHANNEL
        ['https://www.youtube.com/channel/UCabcdefGHIJKLMN',                  Cat::CHANNEL],
        ['https://www.youtube.com/channel/UCabcdefGHIJKLMN/?test=123',        Cat::CHANNEL],
        ['https://www.youtube.com/@MyClappy',                                 Cat::CHANNEL],
        ['https://www.youtube.com/@canaldigplay/videos',                      Cat::CHANNEL],
        ['https://www.youtube.com/ancap_su',                                  Cat::CHANNEL],
        ['https://www.youtube.com/ancap_su/featured?view=0',                  Cat::CHANNEL],

        // USER legacy
        ['https://youtube.com/user/legacyUserName',                           Cat::USER],

        // CUSTOM (/c/)
        ['https://www.youtube.com/c/CustomName123',                           Cat::CUSTOM],

        // PLAYLIST
        ['https://www.youtube.com/playlist?list=PL1234567890',                Cat::PLAYLIST],
    ]);

    //
    // TESTS
    //

    test('matches() aprova URLs válidas do YouTube (expanded)', function (string $url) {
        expect($this->v->matches($url))->toBeTrue();
    })->with('yt-valid-matches');

    test('matches() reprova URLs inválidas/fora do escopo', function (string $url) {
        expect($this->v->matches($url))->toBeFalse();
    })->with('yt-negatives');

    test('detectUrlCategory() classifica corretamente', function (string $url, Cat $expected) {
        expect($this->v->detectUrlCategory($url))->toBe($expected->value);
    })->with('yt-categories');

    // Mix no seu estilo original
    it('many youtube tests at once (expanded)', function () {
        $rows = [
            ['https://www.youtube.com/watch?v=VIDEO12345',                  Cat::VIDEO],
            ['https://www.youtube.com/watch?v=VIDEO12345&sad=123&osos=456', Cat::VIDEO],
            ['https://youtu.be/SHORT67890',                                  Cat::VIDEO],
            ['https://youtube.com/shorts/SHORTID123',                        Cat::SHORTS],
            ['https://www.youtube.com/channel/UCabcdefGHIJKLMN',             Cat::CHANNEL],
            ['https://www.youtube.com/channel/UCabcdefGHIJKLMN/?test=123',   Cat::CHANNEL],
            ['https://youtube.com/user/legacyUserName',                      Cat::USER],
            ['https://www.youtube.com/c/CustomName123',                      Cat::CUSTOM],
            ['https://www.youtube.com/playlist?list=PL1234567890',           Cat::PLAYLIST],
            ['https://www.youtube.com/@MyClappy',                            Cat::CHANNEL],
            ['https://www.youtube.com/@canaldigplay/',                       Cat::CHANNEL],
            ['https://www.youtube.com/ancap_su',                             Cat::CHANNEL],
            ['https://www.youtube-nocookie.com/embed/VIDEO12345?rel=0',      Cat::VIDEO],
        ];

        $v = new YouTubeValidator;
        foreach ($rows as [$u, $expected]) {
            expect($v->matches($u))->toBeTrue();
            expect($v->detectUrlCategory($u))->toBe($expected->value);
        }
    });
});
