<?php

use Jralph\Twig\Markdown\Parsedown\ParsedownExtraMarkdown;
use PHPUnit\Framework\TestCase;

class ParsedownExtraMarkdownTest extends TestCase
{
    /**
     * @var Parsedown|\Mockery\MockInterface
     */
    protected $parsedown;

    /**
     * @var ParsedownExtra
     */
    protected $parsedownExtraMarkdown;

    protected function setUp(): void
    {
        $this->parsedown = Mockery::mock('ParsedownExtra');

        $this->parsedownExtraMarkdown = new ParsedownExtraMarkdown($this->parsedown);
    }

    public function tearDown(): void
    {
        unset($this->parsedownExtraMarkdown);

        Mockery::close();
    }

    public function test_object_is_instance_of_markdown_contract()
    {
        $this->assertInstanceOf('Jralph\Twig\Markdown\Contracts\MarkdownInterface', $this->parsedownExtraMarkdown);
    }

    public function test_parse_method_returns_expected_html()
    {
        $markdown = '# Test';

        $expected = '<h1>Test</h1>';

        $this->parsedown->shouldReceive('parse')->once()->with($markdown)->andReturn($expected);

        $this->assertEquals($expected, $this->parsedownExtraMarkdown->parse($markdown));
    }

}