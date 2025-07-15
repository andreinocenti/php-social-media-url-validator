<?php

use AndreInocenti\SocialMediaUrlValidator\Platforms\YouTubeValidator;

it('matches youtube channel, user, custom, video and shorts urls', function () {
    $v = new YouTubeValidator;
    expect($v->matches('https://www.youtube.com/channel/ABC'))->toBeTrue();
    expect($v->matches('https://youtu.be/channel/ABC'))->toBeTrue();
    expect($v->matches('https://youtube.com/user/johndoe'))->toBeTrue();
    expect($v->matches('http://youtube.com/c/CustomName'))->toBeTrue();
    expect($v->matches('https://www.youtube.com/watch?v=xyz123'))->toBeTrue();
    expect($v->matches('https://youtube.com/shorts/shortID'))->toBeTrue();
});

it('does not match non-youtube urls', function () {
    expect((new YouTubeValidator)->matches('https://vimeo.com/1234'))->toBeFalse();
});

it('detects youtube categories correctly', function () {
    $v = new YouTubeValidator;
    expect($v->detectUrlCategory('https://www.youtube.com/channel/ABC'))->toBe('channel');
    expect($v->detectUrlCategory('https://www.youtube.com/user/johndoe'))->toBe('channel');
    expect($v->detectUrlCategory('https://www.youtube.com/watch?v=xyz123'))->toBe('video');
    expect($v->detectUrlCategory('https://www.youtube.com/shorts/shortID'))->toBe('shorts');
    expect($v->detectUrlCategory('https://www.youtube.com/playlist?list=PL'))->toBeNull();
});
