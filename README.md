# Social Media URL Validator

**Social Media URL Validator** is a lightweight PHP library for validating, parsing, and inspecting URLs—both generic and platform-specific (Instagram, Facebook, TikTok, LinkedIn, YouTube, Twitter). It provides:

- **Generic URL validation and detection**
- **Specific Social Media URL validation and detection**
- **Social Media URL Category validation and detection**

---

## Features

- **URL syntax validation**
- **Platform-specific validation** and **ID extraction**
  - Instagram posts and profiles
  - Facebook posts and pages
  - TikTok videos and profiles
  - LinkedIn posts and profiles
  - YouTube channels, videos, and custom URLs
  - Twitter/X tweets and profiles
---

## Installation

Require the package via Composer:

```bash
composer require andreinocenti/php-social-media-url-validator
```

---

## Validator Basic Usage

```php
use AndreInocenti\SocialUrlValidator\UrlValidator;

$validator = new UrlValidator();

// is Instagram URL detect
echo $validator->isInstagram('https://www.instagram.com/p/POSTID/'));
Output: "instagram"

// Generic social media URL detect
echo $validator->detect('https://www.instagram.com/p/POSTID/'));
Output: "instagram"


// // Instagram post URL check
// $url = 'https://www.instagram.com/p/POSTID/';
// if ($validator->isInstagramUrl($url)) {
//     $postId = $validator->extractInstagramId($url);
//     echo "Instagram Post ID: $postId";
// }

```

---

## URL Category Detection Basic Usage

Beyond simply checking if a URL belongs to a given platform, you can also **detect the specific resource type** (e.g. profile, post, video, reel) using the `detectUrlCategory()` method:

```php
use AndreInocenti\SocialMediaUrlValidator\UrlValidator;

$validator = new UrlValidator;

$url = 'https://www.instagram.com/p/POSTID/';
if ($validator->isInstagram($url)) {
    echo $validator->instagramCategory($url);
    output: 'post'
}

$url = 'https://x.com/X/status/1942652662987776268';
$validator->detectSocialMediaCategory($url);
output: 'post'
```

---
## Social URL Validator Functions

The functions below allow you to validate or detect URLs for various social media platforms. Each function returns `true` if the URL is valid for that platform, or `false` otherwise. Additionally the `detect()` function returns the name of the social media platform if the URL is valid, or `null` if it is not recognized.


| Function                   | Description                                                      |
| -------------------------- | ---------------------------------------------------------------- |
| `isInstagram(string $url)` | Returns `true` if the URL is a valid Instagram profile/post/…    |
| `isTwitter(string $url)`   | Returns `true` if the URL is a valid Twitter/X profile/tweet     |
| `isFacebook(string $url)`  | Returns `true` if the URL is a valid Facebook profile/page/post  |
| `isLinkedIn(string $url)`  | Returns `true` if the URL is a valid LinkedIn profile/company/post |
| `isTikTok(string $url)`    | Returns `true` if the URL is a valid TikTok profile/video       |
| `isYouTube(string $url)`   | Returns `true` if the URL is a valid YouTube channel/video/shorts |
| `detectSocialMedia(string $url)`   | Returns a string with the name of the Social Media for a generic Social Media URL, or `null` if not recognized |


---
## Social Media URL Category Detector


| Function                           | Description                                                                                         |
| ---------------------------------- | --------------------------------------------------------------------------------------------------- |
| `instagramCategory(string $url)`   | Returns the resource category for an Instagram URL (`profile`, `post`, `reel`, `igtv`, or `null`)  |
| `twitterCategory(string $url)`     | Returns the resource category for a Twitter/X URL (`profile`, `tweet`, or `null`)                   |
| `facebookCategory(string $url)`    | Returns the resource category for a Facebook URL (`profile`, `page`, `post`, or `null`)             |
| `linkedInCategory(string $url)`    | Returns the resource category for a LinkedIn URL (`profile`, `company`, `post`, or `null`)          |
| `tiktokCategory(string $url)`      | Returns the resource category for a TikTok URL (`profile`, `video`, or `null`)                      |
| `youTubeCategory(string $url)`     | Returns the resource category for a YouTube URL (`channel`, `user`, `custom`, `video`, `shorts`, or `null`) |
| `detectSocialMediaCategory(string $url)`   | Returns the resource category for a generic Social Media URL, or `null` if not recognized                               |


---

### URL Category Detection - Supported Platforms & Categories

| Platform     | Category   | Example URL                                                |
| ------------ | ---------- | ---------------------------------------------------------- |
| **Instagram**| `profile`  | `https://instagram.com/username/`                          |
|              | `post`     | `https://instagram.com/p/POSTID/`                          |
|              | `reel`     | `https://instagram.com/reel/REELID/`                       |
|              | `igtv`     | `https://instagram.com/tv/VIDEOID/`                        |
| **Twitter/X**| `profile`  | `https://twitter.com/username`                             |
|              | `post`    | `https://twitter.com/username/status/TWEETID`              |
| **Facebook** | `profile`  | `https://facebook.com/profile.php?id=1234`                 |
|              | `page`     | `https://facebook.com/PageName`                            |
|              | `post`     | `https://facebook.com/PageName/posts/POSTID`               |
| **LinkedIn** | `profile`  | `https://linkedin.com/in/username`                         |
|              | `company`  | `https://linkedin.com/company/companyName`                 |
|              | `post`     | `https://linkedin.com/feed/update/urn:li:activity:ACTID`   |
| **TikTok**   | `profile`  | `https://www.tiktok.com/@username`                         |
|              | `video`    | `https://www.tiktok.com/@username/video/VIDEOID`           |
| **YouTube**  | `channel`  | `https://www.youtube.com/channel/CHANNELID`                |
|              | `user`     | `https://www.youtube.com/user/USERNAME`                    |
|              | `custom`   | `https://www.youtube.com/c/CUSTOMNAME`                     |
|              | `video`    | `https://www.youtube.com/watch?v=VIDEOID`                  |
|              | `shorts`   | `https://www.youtube.com/shorts/SHORTID`                   |



## Contributing

Contributions are welcome! Please open issues or pull requests on the GitHub repository.

---

## License

The MIT License (MIT). Please see [LICENSE](LICENSE.md) for more information.

