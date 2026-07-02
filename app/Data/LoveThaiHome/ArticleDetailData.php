<?php

namespace App\Data\LoveThaiHome;

readonly class ArticleDetailData
{
    /**
     * @param  array{id: string, name: string}|null  $category
     */
    public function __construct(
        public string $id,
        public string $name,
        public ?string $text,
        public ?array $category,
        public ?string $coverImageUrl,
        public int $seq,
        public bool $isGlobal,
        public ?string $createdAt,
        public ?string $updatedAt,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            name: (string) ($data['name'] ?? ''),
            text: isset($data['text']) ? (string) $data['text'] : null,
            category: isset($data['category']) ? (array) $data['category'] : null,
            coverImageUrl: isset($data['cover_image_url']) ? (string) $data['cover_image_url'] : null,
            seq: (int) ($data['seq'] ?? 0),
            isGlobal: (bool) ($data['is_global'] ?? false),
            createdAt: isset($data['created_at']) ? (string) $data['created_at'] : null,
            updatedAt: isset($data['updated_at']) ? (string) $data['updated_at'] : null,
        );
    }

    public function renderedText(): string
    {
        if (blank($this->text)) {
            return '';
        }

        if (! str_contains($this->text, '<')) {
            return nl2br(e($this->text));
        }

        $embeds = [];
        $html = self::extractYoutubeEmbeds($this->text, $embeds);

        $allowedTags = '<p><br><br/><strong><b><em><i><u><ul><ol><li><a><img><span><div><table><tr><td><th><tbody><thead><blockquote><hr><figure><figcaption><h1><h2><h3><h4><h5><h6>';

        $html = strip_tags($html, $allowedTags);

        foreach ($embeds as $placeholder => $embed) {
            $html = str_replace($placeholder, $embed, $html);
        }

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
