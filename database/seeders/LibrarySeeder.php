<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Podcast;
use Illuminate\Database\Seeder;

class LibrarySeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Half of a Yellow Sun',
                'author' => 'Chimamanda Ngozi Adichie',
                'isbn' => '9781400095209',
                'description' => 'A sweeping story of love, war, and the quiet costs of belonging—one of those novels that stays with you.',
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9781400095209-L.jpg',
                'is_featured' => true,
            ],
            [
                'title' => 'Americanah',
                'author' => 'Chimamanda Ngozi Adichie',
                'isbn' => '9780307455925',
                'description' => 'A sharp, tender exploration of identity, migration, and what we learn about ourselves when we cross borders.',
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9780307455925-L.jpg',
                'is_featured' => true,
            ],
            [
                'title' => 'We Should All Be Feminists',
                'author' => 'Chimamanda Ngozi Adichie',
                'isbn' => '9780008115272',
                'description' => 'A concise, generous invitation to think differently about power, gender, and how we show up in public life.',
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9780008115272-L.jpg',
                'is_featured' => false,
            ],
            [
                'title' => 'Decolonising the Mind',
                'author' => 'Ngũgĩ wa Thiong\'o',
                'isbn' => '9780852555019',
                'description' => 'A powerful reflection on language, culture, and liberation—essential for anyone thinking about African intellectual life.',
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9780852555019-L.jpg',
                'is_featured' => false,
            ],
            [
                'title' => 'Homegoing',
                'author' => 'Yaa Gyasi',
                'isbn' => '9781101947135',
                'description' => 'Two sisters, two lineages, and generations of history—beautifully written, emotionally precise.',
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9781101947135-L.jpg',
                'is_featured' => false,
            ],
            [
                'title' => 'Born a Crime',
                'author' => 'Trevor Noah',
                'isbn' => '9780399588174',
                'description' => 'Funny, honest, and deeply humane—about family, resilience, and the strange logic of systems that shape everyday life.',
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9780399588174-L.jpg',
                'is_featured' => false,
            ],
            [
                'title' => 'Things Fall Apart',
                'author' => 'Chinua Achebe',
                'isbn' => '9780385474542',
                'description' => 'A classic for a reason: the intimate, complex tragedy of a life caught in historic change.',
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9780385474542-L.jpg',
                'is_featured' => false,
            ],
            [
                'title' => 'The Beautyful Ones Are Not Yet Born',
                'author' => 'Ayi Kwei Armah',
                'isbn' => '9780435908316',
                'description' => 'A quiet, unsettling novel about integrity and survival—what it means to remain clean in dirty systems.',
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9780435908316-L.jpg',
                'is_featured' => false,
            ],
        ];

        foreach ($books as $book) {
            Book::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($book['title'])],
                [
                    'title' => $book['title'],
                    'author' => $book['author'],
                    'isbn' => $book['isbn'],
                    'description' => $book['description'],
                    'cover_image' => $book['cover_image'],
                    'is_featured' => $book['is_featured'],
                    'is_active' => true,
                    'published_at' => now()->subDays(random_int(3, 120)),
                ]
            );
        }

        $podcasts = [
            [
                'title' => 'On Being — The Discipline of Listening',
                'show_name' => 'On Being with Krista Tippett',
                'description' => 'A conversation that slows you down—in the best way. A reminder that attention is a form of care.',
                'external_url' => 'https://podcasts.apple.com/us/podcast/unedited-rachel-naomi-remen-with-krista-tippett/id150892556?i=1000565007381',
                'embed_html' => '<iframe allow="autoplay *; encrypted-media *; fullscreen *; clipboard-write" frameborder="0" height="175" style="width:100%;overflow:hidden;border-radius:12px;display:block;" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation-by-user-activation" src="https://embed.podcasts.apple.com/us/podcast/on-being-with-krista-tippett/id150892556?i=1000565007381" scrolling="no"></iframe>',
                'is_featured' => true,
            ],
            [
                'title' => '99% Invisible — The Design of Everyday Life',
                'show_name' => '99% Invisible',
                'description' => 'Stories about the built world and the invisible decisions that shape how we live.',
                'external_url' => 'https://podcasts.apple.com/us/podcast/99-vernacular-volume-2/id394775318?i=1000571276825',
                'embed_html' => '<iframe allow="autoplay *; encrypted-media *; fullscreen *; clipboard-write" frameborder="0" height="175" style="width:100%;overflow:hidden;border-radius:12px;display:block;" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation-by-user-activation" src="https://embed.podcasts.apple.com/us/podcast/99-invisible/id394775318?i=1000571276825" scrolling="no"></iframe>',
                'is_featured' => true,
            ],
            [
                'title' => 'How I Built This — Starting with a Why',
                'show_name' => 'How I Built This',
                'description' => 'Founder stories, but the best episodes are really about values, constraints, and momentum.',
                'external_url' => 'https://podcasts.apple.com/us/podcast/how-i-built-this-with-guy-raz/id1150510297?i=1000705886619',
                'embed_html' => '<iframe allow="autoplay *; encrypted-media *; fullscreen *; clipboard-write" frameborder="0" height="175" style="width:100%;overflow:hidden;border-radius:12px;display:block;" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation-by-user-activation" src="https://embed.podcasts.apple.com/us/podcast/how-i-built-this-with-guy-raz/id1150510297?i=1000705886619" scrolling="no"></iframe>',
                'is_featured' => false,
            ],
            [
                'title' => 'The Daily — The News, With Context',
                'show_name' => 'The Daily',
                'description' => 'A helpful way to stay informed without feeling constantly overwhelmed.',
                'external_url' => 'https://podcasts.apple.com/us/podcast/the-tragic-death-and-enduring-legacy-of-rob-reiner/id1200361736?i=1000741666479',
                'embed_html' => '<iframe allow="autoplay *; encrypted-media *; fullscreen *; clipboard-write" frameborder="0" height="175" style="width:100%;overflow:hidden;border-radius:12px;display:block;" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation-by-user-activation" src="https://embed.podcasts.apple.com/us/podcast/the-daily/id1200361736?i=1000741666479" scrolling="no"></iframe>',
                'is_featured' => false,
            ],
            [
                'title' => 'The Ezra Klein Show — Institutions and Imagination',
                'show_name' => 'The Ezra Klein Show',
                'description' => 'Long-form conversations that help you think more clearly about power, systems, and tradeoffs.',
                'external_url' => 'https://podcasts.apple.com/us/podcast/best-of-the-quiet-catastrophe-brewing-in-our-social-lives/id1548604447?i=1000738305359',
                'embed_html' => '<iframe allow="autoplay *; encrypted-media *; fullscreen *; clipboard-write" frameborder="0" height="175" style="width:100%;overflow:hidden;border-radius:12px;display:block;" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation-by-user-activation" src="https://embed.podcasts.apple.com/us/podcast/the-ezra-klein-show/id1548604447?i=1000738305359" scrolling="no"></iframe>',
                'is_featured' => false,
            ],
        ];

        foreach ($podcasts as $podcast) {
            Podcast::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($podcast['title'])],
                [
                    'title' => $podcast['title'],
                    'show_name' => $podcast['show_name'],
                    'description' => $podcast['description'],
                    'external_url' => $podcast['external_url'],
                    'embed_html' => $podcast['embed_html'],
                    'is_featured' => $podcast['is_featured'],
                    'is_active' => true,
                    'listened_at' => now()->subDays(random_int(1, 45)),
                ]
            );
        }
    }
}
