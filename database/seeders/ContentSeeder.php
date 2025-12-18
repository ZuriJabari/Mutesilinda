<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HeroSection;
use App\Models\MenuItem;
use App\Models\QuickLink;
use App\Models\Affiliation;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $duplicateMenuItems = DB::table('menu_items')
            ->select('label', 'url', DB::raw('MIN(id) as keep_id'))
            ->groupBy('label', 'url')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicateMenuItems as $row) {
            DB::table('menu_items')
                ->where('label', $row->label)
                ->where('url', $row->url)
                ->where('id', '!=', $row->keep_id)
                ->delete();
        }

        $duplicateQuickLinks = DB::table('quick_links')
            ->select('label', 'url', DB::raw('MIN(id) as keep_id'))
            ->groupBy('label', 'url')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicateQuickLinks as $row) {
            DB::table('quick_links')
                ->where('label', $row->label)
                ->where('url', $row->url)
                ->where('id', '!=', $row->keep_id)
                ->delete();
        }

        $duplicateAffiliations = DB::table('affiliations')
            ->select('name', 'url', DB::raw('MIN(id) as keep_id'))
            ->groupBy('name', 'url')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicateAffiliations as $row) {
            DB::table('affiliations')
                ->where('name', $row->name)
                ->where('url', $row->url)
                ->where('id', '!=', $row->keep_id)
                ->delete();
        }

        $duplicateHeroSections = DB::table('hero_sections')
            ->select('order', DB::raw('MIN(id) as keep_id'))
            ->groupBy('order')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach ($duplicateHeroSections as $row) {
            DB::table('hero_sections')
                ->where('order', $row->order)
                ->where('id', '!=', $row->keep_id)
                ->delete();
        }

        $aboutContent = <<<'HTML'
<p>Hello, I’m Linda Mutesi.</p>

<p>For more than fifteen years, I have been fortunate to work alongside passionate community builders in Uganda—people who nurture creativity, innovation, and opportunity. My journey has taken me across diverse fields: supporting talent development, championing the visual arts, mentoring youth and women-led startups, and advocating for the causes I believe in.</p>

<h2>At a glance</h2>
<ul>
  <li>Partner at Adalci Advocates (lawyer by training)</li>
  <li>Community builder working across the arts, women-led enterprise, and civic participation</li>
  <li>Master’s student in Philanthropic Studies (University of Kent, UK)</li>
  <li>Mother of two teenage boys; reader; lifelong learner</li>
</ul>

<details>
  <summary>Community, creativity, and opportunity</summary>
  <p>My work is grounded in a commitment to social justice, reflective culture, and the power of creative expression to bring people together.</p>
  <p>My interests span the visual arts, women-led business, African literature, youth enterprise, and the ongoing work of interrogating African philanthropy.</p>
</details>

<details>
  <summary>Law, leadership, and learning</summary>
  <p>A trained lawyer and Partner at Adalci Advocates, I also serve on several boards as a Director, Co-Founder, and Patron.</p>
  <p>Currently, I am pursuing a Master’s degree in Philanthropic Studies at the University of Kent in the UK. Beyond my professional life, I am a mother of two teenage boys, a curious reader, and an enthusiastic participant in spaces that question, teach, and grow the mind.</p>
</details>

<details>
  <summary>Bold Woman Fund and Bold in Africa</summary>
  <p>Through The Bold Woman Fund, we work with Ugandan women entrepreneurs in fashion and design—offering training and retail opportunities at Bold in Africa, a store dedicated to showcasing exclusively made-in-Africa brands.</p>
  <p>This initiative is rooted in a belief I hold deeply: women are the backbone of our societies, and skilled women multiply resources across communities.</p>
</details>

<details>
  <summary>Initiatives and contributions</summary>
  <p>Alongside my personal and professional journey, I have been fortunate to contribute to initiatives that reflect my passion for community building, creativity, and social change.</p>
  <p>At 32 Degrees East, where I have served as a Trustee and Board Member since 2018, I work with the centre’s leadership to strengthen contemporary art practice in Uganda.</p>
  <p>As the outgoing Board Chairperson of Taala Foundation, I supported the organisation’s leadership with strategy in work that centres mental health awareness and creative therapy for sexual minorities—an area of life that is often overlooked, yet vital for community well-being.</p>
  <p>In 2022, I co-founded the FG Foundation, a platform dedicated to interrogating African philanthropy and community building.</p>
  <p>At The Citizen Report–Uganda, which I founded in 2021, we encourage civic participation and amplify citizen voices in governance and social justice.</p>
  <p>Beyond these, I have served as a Governor at 7 Hills International School supporting educational excellence, and as Director and Secretary at FundiBots Ltd—an organisation that equips young people with practical science and robotics skills for the future.</p>
</details>

<details>
  <summary>Vision</summary>
  <p>Looking ahead, my vision is to see each of these initiatives grow in sustainability and impact over the next decade. Together, they embody the values I hold close: empowerment, creativity, justice, and the belief that communities thrive when opportunities are shared.</p>
</details>

<hr>

<details open>
  <summary>This space</summary>
  <p>This blog is where I bring these journeys together. Here, you’ll find personal reflections on my work as a lawyer, philanthropy student, and community collaborator; behind-the-scenes insights into the projects I’m part of; and conversations with fellow creatives who are making a difference in their fields. At its core, this space is about storytelling—the kind that uplifts, challenges, and connects us.</p>
  <p>I believe deeply in the transformative power of art: its ability to change lives, expand perspectives, and bridge communities. My hope is that through these stories and reflections, you’ll not only glimpse the work I do, but also discover the wider beauty of human expression and connection.</p>
  <p>I invite you to join me on this journey. By signing up for my newsletter, you’ll receive personal stories, creative insights, and updates on the projects that bring me joy.</p>
</details>

<p>With warmth,<br>Linda Mutesi</p>
HTML;

        $privacyContent = <<<'HTML'
<p><strong>Effective date:</strong> December 18, 2025</p>

<p>This Privacy Policy explains how Linda Mutesi ("we", "us", "our") collects, uses, and protects your information when you visit and use this website.</p>

<h2>Information we collect</h2>
<ul>
  <li><strong>Information you provide</strong>: If you contact us (for example via a contact form or email), you may provide your name, email address, and any details you include in your message.</li>
  <li><strong>Newsletter information</strong>: If you subscribe to a newsletter, we collect the email address you submit and any preferences you choose to share.</li>
  <li><strong>Usage data</strong>: Like most websites, we may collect basic technical information such as browser type, device information, IP address, and pages visited, to understand how the site is used and to improve performance.</li>
</ul>

<h2>How we use your information</h2>
<ul>
  <li>To respond to messages and inquiries</li>
  <li>To send newsletters or updates if you opted in</li>
  <li>To maintain, protect, and improve the website</li>
  <li>To monitor for security, spam, or abuse</li>
</ul>

<h2>Cookies</h2>
<p>We may use cookies or similar technologies to help the site function, remember preferences, and understand usage. You can control cookies through your browser settings. Disabling cookies may affect certain features of the site.</p>

<h2>Sharing of information</h2>
<p>We do not sell your personal information. We may share information only in limited circumstances, such as:</p>
<ul>
  <li><strong>Service providers</strong> who help operate the website (for example, hosting, analytics, or email delivery), under appropriate confidentiality and security obligations</li>
  <li><strong>Legal requirements</strong> if we are required to comply with a law, regulation, legal process, or enforceable governmental request</li>
  <li><strong>Security</strong> to protect rights, safety, and integrity of the site and its visitors</li>
</ul>

<h2>External links</h2>
<p>This website may link to external sites (for example, social platforms or third-party content). We are not responsible for the privacy practices of those sites. Please review their policies before providing personal information.</p>

<h2>Data retention</h2>
<p>We keep personal information only as long as necessary for the purposes described above, unless a longer retention period is required or permitted by law.</p>

<h2>Your rights and choices</h2>
<ul>
  <li>You may request access, correction, or deletion of your personal information where applicable.</li>
  <li>You can opt out of marketing emails/newsletters at any time by using the unsubscribe link (if provided) or by contacting us.</li>
</ul>

<h2>Security</h2>
<p>We take reasonable steps to protect your information. However, no method of transmission or storage is 100% secure, and we cannot guarantee absolute security.</p>

<h2>Changes to this policy</h2>
<p>We may update this Privacy Policy from time to time. We will update the effective date at the top of this page when changes are made.</p>

<h2>Contact</h2>
<p>If you have questions about this Privacy Policy, please contact us via the <a href="/contact">contact page</a>.</p>
HTML;

        $termsContent = <<<'HTML'
<p><strong>Effective date:</strong> December 18, 2025</p>

<p>These Terms of Service ("Terms") govern your access to and use of this website operated by Linda Mutesi ("we", "us", "our"). By accessing or using the site, you agree to these Terms. If you do not agree, please do not use the site.</p>

<h2>Use of the website</h2>
<ul>
  <li>You may use this website for lawful purposes only.</li>
  <li>You agree not to attempt to disrupt, damage, or gain unauthorized access to the website, its servers, or connected systems.</li>
  <li>We may update, suspend, or discontinue parts of the website at any time.</li>
</ul>

<h2>Content</h2>
<p>All content on this website (including text, images, audio, video, and design) is provided for general information and personal enjoyment unless otherwise stated.</p>
<ul>
  <li><strong>Intellectual property</strong>: Unless noted otherwise, the content is owned by or licensed to Linda Mutesi and is protected by applicable intellectual property laws.</li>
  <li><strong>Limited permission</strong>: You may share links to pages publicly. You may not copy, reproduce, or republish substantial portions of the content without permission.</li>
</ul>

<h2>Third-party links and embeds</h2>
<p>This website may include links to third-party sites and embedded content (for example podcast players). We do not control third-party services and are not responsible for their content, policies, or availability. Your use of third-party services is at your own risk.</p>

<h2>Accounts (if applicable)</h2>
<p>If any portion of the site requires an account, you are responsible for maintaining the confidentiality of your login credentials and for all activity under your account.</p>

<h2>Disclaimers</h2>
<ul>
  <li>This website is provided on an "as is" and "as available" basis. We make no warranties that the site will be uninterrupted, error-free, or secure.</li>
  <li>Any information on this website does not constitute professional advice (legal, financial, medical, or otherwise). You should seek appropriate professional advice for your situation.</li>
</ul>

<h2>Limitation of liability</h2>
<p>To the fullest extent permitted by law, we will not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, arising from your use of the website.</p>

<h2>Indemnification</h2>
<p>You agree to indemnify and hold harmless Linda Mutesi from any claims, liabilities, damages, losses, and expenses (including reasonable legal fees) arising out of or related to your use of the website or your violation of these Terms.</p>

<h2>Changes to these Terms</h2>
<p>We may update these Terms from time to time. We will update the effective date at the top of this page when changes are made.</p>

<h2>Contact</h2>
<p>If you have questions about these Terms, please contact us via the <a href="/contact">contact page</a>.</p>
HTML;

        // Hero Section
        HeroSection::updateOrCreate([
            'order' => 1,
        ], [
            'greeting' => 'Hello, I’m',
            'name' => 'Linda Mutesi!',
            'description' => 'I work with artists, entrepreneurs, and civic leaders to grow opportunity across Uganda and beyond — nurturing creativity, championing women- and youth-led enterprises, and advancing African philanthropy. This blog is where I bring these journeys together — reflections, behind-the-scenes insights, and conversations with fellow creatives. I invite you to join me on this journey.',
            'image_path' => '/images/linda-hero.png',
            'is_active' => true,
            'order' => 1,
        ]);

        // Menu Items
        $menuItems = [
            ['label' => 'Home', 'url' => '/', 'order' => 1],
            ['label' => 'About', 'url' => '/about', 'order' => 2],
            ['label' => 'Affiliations', 'url' => '#', 'has_dropdown' => true, 'order' => 3],
            ['label' => 'Thinking About', 'url' => '/blog', 'order' => 4],
            ['label' => 'Library', 'url' => '/library', 'order' => 5],
            ['label' => 'Research Interests', 'url' => '/research-interests', 'order' => 6],
            ['label' => 'Get in Touch', 'url' => '/contact', 'order' => 7],
        ];

        foreach ($menuItems as $item) {
            MenuItem::updateOrCreate(
                ['label' => $item['label'], 'url' => $item['url']],
                array_merge(['is_active' => true], $item)
            );
        }

        // Quick Links
        $quickLinks = [
            [
                'label' => 'Affiliations',
                'title' => 'Organizations I Work With',
                'url' => '#affiliations',
                'bg_color' => '#F3EEE9',
                'order' => 1,
            ],
            [
                'label' => 'Thinking About',
                'title' => 'Reflections & Insights',
                'url' => '/blog',
                'bg_color' => '#EDE8F0',
                'order' => 2,
            ],
            [
                'label' => 'Research',
                'title' => 'Research Interests',
                'url' => '/research-interests',
                'bg_color' => '#E7EFEA',
                'order' => 3,
            ],
            [
                'label' => 'Get in Touch',
                'title' => 'Let\'s Connect',
                'url' => '#contact',
                'bg_color' => '#F3EEE9',
                'order' => 4,
            ],
        ];

        foreach ($quickLinks as $link) {
            QuickLink::updateOrCreate(
                ['label' => $link['label'], 'url' => $link['url']],
                array_merge(['is_active' => true], $link)
            );
        }

        // Affiliations
        $affiliations = [
            ['name' => 'Adalci Advocates', 'url' => 'https://adalci.co.ug/our-team/', 'order' => 1],
            ['name' => 'FG Foundation', 'url' => 'https://fgfoundation.africa', 'order' => 2],
            ['name' => 'Bold Woman Fund', 'url' => 'https://www.theboldwomanfund.com/thefounders', 'order' => 3],
            ['name' => 'Bold in Africa', 'url' => 'https://www.boldinafrica.com/aboutus', 'order' => 4],
            ['name' => 'The Citizen Report–Uganda', 'url' => 'https://thecitizenreport.ug', 'order' => 5],
            ['name' => '32 Degrees East', 'url' => 'https://32east.org', 'order' => 6],
        ];

        foreach ($affiliations as $affiliation) {
            Affiliation::updateOrCreate(
                ['name' => $affiliation['name'], 'url' => $affiliation['url']],
                array_merge(['is_active' => true], $affiliation)
            );
        }

        Page::updateOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'About Linda',
                'content' => $aboutContent,
                'is_published' => true,
                'meta_title' => 'About - Linda Mutesi',
                'meta_description' => 'Learn more about Linda Mutesi—lawyer, community builder, and philanthropy student working across the arts, women-led enterprise, and social justice.',
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'privacy'],
            [
                'title' => 'Privacy Policy',
                'content' => $privacyContent,
                'is_published' => true,
                'meta_title' => 'Privacy Policy - Linda Mutesi',
                'meta_description' => 'Read the privacy policy for Linda Mutesi’s website, including how information is collected, used, and protected.',
            ]
        );

        Page::updateOrCreate(
            ['slug' => 'terms'],
            [
                'title' => 'Terms of Service',
                'content' => $termsContent,
                'is_published' => true,
                'meta_title' => 'Terms of Service - Linda Mutesi',
                'meta_description' => 'Read the terms of service for using Linda Mutesi’s website.',
            ]
        );
    }
}
