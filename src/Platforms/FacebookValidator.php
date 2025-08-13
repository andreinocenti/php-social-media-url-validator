<?php

namespace AndreInocenti\SocialMediaUrlValidator\Platforms;

use AndreInocenti\SocialMediaUrlValidator\Contracts\PlatformValidator;
use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;

class FacebookValidator implements PlatformValidator
{
    public function matches(string $url): bool
    {
        $host   = '(?:[\\w-]+\\.)?facebook\\.com';
        $suffix = '(?:/)?(?:[?#&].*)?$';

        $specific = [
            // PROFILE numeric
            "~^(?:https?://)?{$host}/profile\\.php\\?id=\\d+{$suffix}~i",

            // PROFILE vanity (nega rotas reservadas)
            "~^(?:https?://)?{$host}/"
                . "(?!(?:posts|videos|watch|reel|groups|story\\.php|events|help|gaming|marketplace|messages|notifications|settings|home|plugins|privacy|policies|legal|people|pages|places|permalink)(?:/|$|[?#&]))"
                . "[0-9A-Za-z\\.]+{$suffix}~i",

            // POST (page), story.php, grupos (posts|permalink)
            "~^(?:https?://)?{$host}/[^/]+/posts/[A-Za-z0-9_-]+{$suffix}~i",
            "~^(?:https?://)?{$host}/story\\.php\\?story_fbid=\\d+&id=\\d+{$suffix}~i",
            "~^(?:https?://)?{$host}/groups/\\d+/(?:posts|permalink)/[A-Za-z0-9_-]+{$suffix}~i",

            // VIDEO (video.php|/videos/), watch?v=, reel/, fb.watch
            "~^(?:https?://)?{$host}/(?:video\\.php\\?v=|[^/]+/videos/)\\d+{$suffix}~i",
            "~^(?:https?://)?{$host}/watch/?\\?v=[A-Za-z0-9]+(?:[?#&].*)?$~i",
            "~^(?:https?://)?{$host}/reel/[A-Za-z0-9]+{$suffix}~i",
            "~^(?:https?://)?fb\\.watch/[A-Za-z0-9_]+{$suffix}~i",
        ];

        foreach ($specific as $pattern) {
            if (preg_match($pattern, $url)) {
                return true;
            }
        }

        // Fallback: qualquer domínio Facebook/fb.watch
        return (bool) preg_match("~^(?:https?://)?(?:{$host}|fb\\.watch)(?:/|$)~i", $url);
    }

    public function detectUrlCategory(string $url): ?string
    {
        // aceita web., pt-br., es-la., m., mbasic., etc.
        $host   = '(?:[\\w-]+\\.)?facebook\\.com';
        // barra final opcional + query/fragment opcionais
        $suffix = '(?:/)?(?:[?#&].*)?$';

        // slug com unicode + %XX + pontuação comum em nomes de páginas
        $slug   = "(?:%[0-9A-Fa-f]{2}|[\\p{L}\\p{N}._-])+";

        // 1) POSTS (evita capturar "posts" de páginas/category)
        $postPatterns = [
            "~^(?:https?://)?{$host}/[^/]+/posts/([A-Za-z0-9_-]+){$suffix}~i",
            "~^(?:https?://)?{$host}/story\\.php\\?story_fbid=(\\d+)&id=\\d+{$suffix}~i",
            "~^(?:https?://)?{$host}/groups/\\d+/(?:posts|permalink)/([A-Za-z0-9_-]+){$suffix}~i",
        ];
        foreach ($postPatterns as $p) {
            if (preg_match($p, $url)) {
                return PlatformsCategoriesEnum::POST->value;
            }
        }

        // 2) VÍDEOS
        $videoPatterns = [
            "~^(?:https?://)?{$host}/(?:video\\.php\\?v=|[^/]+/videos/)(\\d+){$suffix}~i",
            "~^(?:https?://)?{$host}/watch/?\\?v=([A-Za-z0-9]+)(?:[?#&].*)?$~i",
            "~^(?:https?://)?fb\\.watch/([A-Za-z0-9_]+){$suffix}~i",
            "~^(?:https?://)?{$host}/reel/([A-Za-z0-9]+){$suffix}~i",
        ];
        foreach ($videoPatterns as $p) {
            if (preg_match($p, $url)) {
                return PlatformsCategoriesEnum::VIDEO->value;
            }
        }

        // 3) PERFIL/PÁGINA (cobre muita herança: pages/..., people/..., groups raiz, gaming, pg, login, vanity com unicode)
        $profilePatterns = [
            // profile.php com ou sem id — dataset pede tratar como PROFILE
            "~^(?:https?://)?{$host}/profile\\.php(?:\\?id=(\\d+))?{$suffix}~i",

            // /people/NOME/ID
            "~^(?:https?://)?{$host}/people/{$slug}/(\\d+){$suffix}~iu",

            // /pages/NOME/ID  (e variação sem ID)
            "~^(?:https?://)?{$host}/pages/{$slug}/(\\d+){$suffix}~iu",
            "~^(?:https?://)?{$host}/pages/{$slug}{$suffix}~iu",

            // /pages/category/CATEGORIA/SLUG[/posts/]
            "~^(?:https?://)?{$host}/pages/category/{$slug}/({$slug})(?:/posts/)?{$suffix}~iu",

            // /pg/SLUG
            "~^(?:https?://)?{$host}/pg/({$slug}){$suffix}~iu",

            // /gaming/SLUG
            "~^(?:https?://)?{$host}/gaming/({$slug}){$suffix}~iu",

            // grupos (página raiz do grupo: id ou slug) → PROFILE no teu dataset
            "~^(?:https?://)?{$host}/groups/(?:\\d+|{$slug}){$suffix}~iu",

            // /login/ALGUMA_COISA — dataset marca como PROFILE
            "~^(?:https?://)?{$host}/login/({$slug}){$suffix}~iu",

            // Vanity genérico com 0 ou 1 subpágina NÃO-reservada (ex.: /InvestNordeste/about/)
            "~^(?:https?://)?{$host}/"
                . "(?!(?:posts|videos|watch|reel|groups|story\\.php|events|help|gaming|marketplace|messages|notifications|settings|home|plugins|privacy|policies|legal|people|pages|places|permalink|profile\\.php)(?:/|$|[?#&]))"
                . "({$slug})(?:/(?!posts|videos|watch|reel|groups|story\\.php)[^/?#]+)?{$suffix}~iu",
        ];
        foreach ($profilePatterns as $p) {
            if (preg_match($p, $url)) {
                return PlatformsCategoriesEnum::PROFILE->value;
            }
        }

        return null;
    }
}
