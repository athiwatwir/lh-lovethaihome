<?php

namespace Tests\Unit;

use App\Support\RichHtml;
use Tests\TestCase;

class RichHtmlTest extends TestCase
{
    public function test_render_preserves_empty_paragraph_as_spacer(): void
    {
        $html = RichHtml::render('<p>บรรทัดแรก</p><p></p><p>บรรทัดสาม</p>');

        $this->assertStringContainsString('rich-html-spacer', $html);
        $this->assertStringContainsString('บรรทัดแรก', $html);
        $this->assertStringContainsString('บรรทัดสาม', $html);
    }

    public function test_render_converts_newlines_inside_paragraph_to_breaks(): void
    {
        $html = RichHtml::render("<p>บรรทัดแรก\n\nบรรทัดสอง</p>");

        $this->assertStringContainsString('บรรทัดแรก<br><br>บรรทัดสอง', $html);
    }

    public function test_render_converts_plain_text_newlines(): void
    {
        $html = RichHtml::render("บรรทัดแรก\n\nบรรทัดสอง");

        $this->assertStringContainsString('<br />', $html);
        $this->assertStringContainsString('บรรทัดแรก', $html);
        $this->assertStringContainsString('บรรทัดสอง', $html);
    }
}
