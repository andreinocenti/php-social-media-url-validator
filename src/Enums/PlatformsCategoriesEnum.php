<?php
namespace AndreInocenti\SocialMediaUrlValidator\Enums;

enum PlatformsCategoriesEnum: string
{
    case POST = 'post';
    case REEL = 'reel';
    case IGTV = 'igtv';
    case PROFILE = 'profile';
    case VIDEO = 'video';
    case CHANNEL = 'channel';
    case GROUP = 'group';
    case PAGE = 'page';
    case COMPANY = 'company';
    case USER = 'user';
    case CUSTOM = 'custom';
    case SHORTS = 'shorts';
    case STORY = 'story';
    case LIVE = 'live';
    case FEED = 'feed';
    case PLAYLIST = 'playlist';
    case ACTIVITY = 'activity';
}