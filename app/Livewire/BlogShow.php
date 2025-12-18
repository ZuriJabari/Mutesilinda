<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogShow extends Component
{
    public $slug;
    public $post;
    public $readingTimeMinutes;
    public $renderedContent;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->post = BlogPost::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $text = trim(preg_replace('/\s+/', ' ', strip_tags((string) $this->post->content)));
        $wordCount = $text === '' ? 0 : str_word_count($text);
        $this->readingTimeMinutes = max(1, (int) ceil($wordCount / 200));

        $html = $this->normalizeInlineImageUrls((string) $this->post->content);
        $this->renderedContent = $this->addMediaCaptions($html);
    }

    protected function normalizeInlineImageUrls(string $html): string
    {
        if ($html === '') {
            return $html;
        }

        return preg_replace_callback(
            '/(<img\b[^>]*\bsrc=)(["\'])([^"\']+)(\2[^>]*>)/i',
            function ($matches) {
                $prefix = $matches[1];
                $quote = $matches[2];
                $src = $matches[3];
                $suffix = $matches[4];

                if (str_starts_with($src, '/http://') || str_starts_with($src, '/https://')) {
                    $src = ltrim($src, '/');
                }

                if (
                    str_starts_with($src, 'http') ||
                    str_starts_with($src, '/') ||
                    str_starts_with($src, 'data:')
                ) {
                    return $prefix.$quote.$src.$suffix;
                }

                $src = ltrim($src, './');

                if (str_starts_with($src, 'storage/')) {
                    return $prefix.$quote.'/'.ltrim($src, '/').$suffix;
                }

                $url = Storage::disk('public')->url($src);

                return $prefix.$quote.$url.$suffix;
            },
            $html
        ) ?? $html;
    }

    protected function addMediaCaptions(string $html): string
    {
        if ($html === '') {
            return $html;
        }

        $previousUseInternal = libxml_use_internal_errors(true);
        $previousDisableEntityLoader = null;
        if (function_exists('libxml_disable_entity_loader')) {
            $previousDisableEntityLoader = libxml_disable_entity_loader(true);
        }

        $dom = new \DOMDocument();

        $loaded = $dom->loadHTML(
            '<?xml encoding="utf-8" ?>'.$html,
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );

        if ($loaded === false) {
            libxml_clear_errors();
            libxml_use_internal_errors($previousUseInternal);
            if ($previousDisableEntityLoader !== null) {
                libxml_disable_entity_loader($previousDisableEntityLoader);
            }
            return $html;
        }

        $targets = [];
        foreach (['img', 'video', 'iframe'] as $tag) {
            $nodes = $dom->getElementsByTagName($tag);
            foreach ($nodes as $node) {
                $targets[] = $node;
            }
        }

        foreach (array_reverse($targets) as $node) {
            if (!($node instanceof \DOMElement)) {
                continue;
            }

            $title = trim((string) $node->getAttribute('title'));
            if ($title === '') {
                continue;
            }

            $parent = $node->parentNode;
            if (!$parent) {
                continue;
            }

            if (strtolower((string) $parent->nodeName) === 'figure') {
                continue;
            }

            $figure = $dom->createElement('figure');
            $caption = $dom->createElement('figcaption');
            $caption->appendChild($dom->createTextNode($title));

            $parent->replaceChild($figure, $node);
            $figure->appendChild($node);
            $figure->appendChild($caption);
        }

        $result = $dom->saveHTML();

        libxml_clear_errors();
        libxml_use_internal_errors($previousUseInternal);
        if ($previousDisableEntityLoader !== null) {
            libxml_disable_entity_loader($previousDisableEntityLoader);
        }

        return is_string($result) ? $result : $html;
    }

    public function render()
    {
        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $this->post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        $metaTitle = $this->post->meta_title ?: $this->post->title;
        $metaDescription = $this->post->meta_description
            ?: ($this->post->excerpt ?: Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags((string) $this->post->content))), 160));

        $metaUrl = url()->current();
        $featuredImage = $this->post->featured_image;
        $metaImage = null;
        if (is_string($featuredImage) && $featuredImage !== '') {
            $metaImage = str_starts_with($featuredImage, 'http') ? $featuredImage : url($featuredImage);
        }

        return view('livewire.blog-show', [
            'relatedPosts' => $relatedPosts,
            'readingTimeMinutes' => $this->readingTimeMinutes,
            'renderedContent' => $this->renderedContent,
        ])->layout('layouts.app', [
            'title' => $this->post->title . ' - Mutesilinda',
            'metaTitle' => $metaTitle,
            'metaDescription' => $metaDescription,
            'metaImage' => $metaImage,
            'metaUrl' => $metaUrl,
        ]);
    }
}
