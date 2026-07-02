<?php

namespace Tests\Unit;

use App\Data\LoveThaiHome\ArticleDetailData;
use Tests\TestCase;

class ArticleDetailDataTest extends TestCase
{
    public function test_rendered_text_preserves_youtube_embed_wrapper(): void
    {
        $article = ArticleDetailData::fromArray([
            'id' => 'article-1',
            'name' => 'Test article',
            'text' => '<p>Intro</p><div data-youtube-video="" class="youtube-embed-wrapper"><iframe src="https://www.youtube.com/embed/fgExiCdU8AU" class="youtube-embed" frameborder=></iframe></div><p>Outro</p>',
        ]);

        $html = $article->renderedText();

        $this->assertStringContainsString('<p>Intro</p>', $html);
        $this->assertStringContainsString('<p>Outro</p>', $html);
        $this->assertStringContainsString('youtube.com/embed/fgExiCdU8AU', $html);
        $this->assertStringContainsString('<iframe', $html);
        $this->assertStringContainsString('youtube-embed-wrapper', $html);
    }
}
