<?php

namespace App\Support;

class RichHtml
{
    public static function render(?string $html): string
    {
        if (blank($html)) {
            return '';
        }

        if (! str_contains($html, '<')) {
            return nl2br(e($html));
        }

        $embeds = [];
        $processed = self::extractYoutubeEmbeds($html, $embeds);

        $allowedTags = '<p><br><br/><strong><b><em><i><u><s><strike><del><ul><ol><li><a><img><span><div><table><tr><td><th><tbody><thead><blockquote><hr><figure><figcaption><h1><h2><h3><h4><h5><h6><iframe>';

        $processed = strip_tags($processed, $allowedTags);

        $processed = self::preserveLineBreaks($processed);

        foreach ($embeds as $placeholder => $embed) {
            $processed = str_replace($placeholder, $embed, $processed);
        }

        return $processed;
    }

    private static function preserveLineBreaks(string $html): string
    {
        // Rich text editors use empty paragraphs for blank lines.
        $html = preg_replace(
            '/<p>(?:\s|&nbsp;|&#0*160;|<br\s*\/?>)*<\/p>/i',
            '<p class="rich-html-spacer">&nbsp;</p>',
            $html,
        ) ?? $html;

        // Literal newlines inside block tags (common when pasted from plain text).
        $html = preg_replace_callback(
            '/<(p|li|td|th|figcaption|blockquote)([^>]*)>(.*?)<\/\1>/is',
            static function (array $matches): string {
                $inner = preg_replace("/\r\n|\n|\r/", '<br>', $matches[3]) ?? $matches[3];

                return '<'.$matches[1].$matches[2].'>'.$inner.'</'.$matches[1].'>';
            },
            $html,
        ) ?? $html;

        return $html;
    }

    /**
     * @param  array<string, string>  $embeds
     */
    private static function extractYoutubeEmbeds(string $html, array &$embeds): string
    {
        $index = 0;

        $html = preg_replace_callback(
            '/<div\b[^>]*data-youtube-video[^>]*>.*?<\/div>/is',
            function (array $matches) use (&$embeds, &$index): string {
                $embed = self::buildYoutubeEmbedFromHtml($matches[0]);

                if ($embed === null) {
                    return '';
                }

                $placeholder = '___YOUTUBE_EMBED_'.$index.'___';
                $embeds[$placeholder] = $embed;
                $index++;

                return $placeholder;
            },
            $html,
        ) ?? $html;

        return preg_replace_callback(
            '/<iframe\b[^>]*\bsrc=(["\']?)(https?:\/\/(?:www\.)?(?:youtube\.com\/embed\/|youtube-nocookie\.com\/embed\/)[^"\'\s>]+)\1?[^>]*>(?:\s*<\/iframe>)?/is',
            function (array $matches) use (&$embeds, &$index): string {
                $embed = self::buildYoutubeEmbedFromUrl($matches[2]);

                if ($embed === null) {
                    return '';
                }

                $placeholder = '___YOUTUBE_EMBED_'.$index.'___';
                $embeds[$placeholder] = $embed;
                $index++;

                return $placeholder;
            },
            $html,
        ) ?? $html;
    }

    private static function buildYoutubeEmbedFromHtml(string $html): ?string
    {
        if (! preg_match('/\bsrc=(["\']?)(https?:\/\/[^"\'\s>]+)\1?/i', $html, $matches)) {
            return null;
        }

        return self::buildYoutubeEmbedFromUrl($matches[2]);
    }

    private static function buildYoutubeEmbedFromUrl(string $url): ?string
    {
        $videoId = self::extractYoutubeVideoId($url);

        if ($videoId === null) {
            return null;
        }

        $embedUrl = 'https://www.youtube.com/embed/'.$videoId;

        return '<div class="youtube-embed-wrapper relative my-6 aspect-video w-full overflow-hidden rounded-xl bg-black">'
            .'<iframe class="absolute inset-0 h-full w-full border-0" src="'.e($embedUrl).'" '
            .'title="YouTube video" loading="lazy" '
            .'allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" '
            .'referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>'
            .'</div>';
    }

    private static function extractYoutubeVideoId(string $url): ?string
    {
        $url = trim(html_entity_decode($url, ENT_QUOTES | ENT_HTML5));

        if (preg_match('/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?(?:.*&)?v=|embed\/|shorts\/|live\/)|youtu\.be\/|youtube-nocookie\.com\/embed\/)([a-zA-Z0-9_-]{11})/', $url, $matches)) {
            return $matches[1];
        }

        if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            return $url;
        }

        return null;
    }
}
