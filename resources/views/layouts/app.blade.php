<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Mutesilinda') }}</title>

    @if(!empty($metaTitle))
        <meta property="og:title" content="{{ $metaTitle }}">
        <meta name="twitter:title" content="{{ $metaTitle }}">
    @endif

    @if(!empty($metaDescription))
        <meta name="description" content="{{ $metaDescription }}">
        <meta property="og:description" content="{{ $metaDescription }}">
        <meta name="twitter:description" content="{{ $metaDescription }}">
    @endif

    @if(!empty($metaImage))
        <meta property="og:image" content="{{ $metaImage }}">
        <meta name="twitter:image" content="{{ $metaImage }}">
    @endif

    @if(!empty($metaUrl))
        <link rel="canonical" href="{{ $metaUrl }}">
        <meta property="og:url" content="{{ $metaUrl }}">
    @endif

    <meta property="og:type" content="article">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body x-data="{}" x-init="if (new URLSearchParams(window.location.search).get('contact') === '1') { $store.contact.open(); }" class="min-h-screen font-sans antialiased bg-[#fbfaf9] text-zinc-950 selection:bg-rose-200/60 selection:text-zinc-950">
    @include('components.header')

    <main>
        {{ $slot }}
    </main>

    @include('components.footer')

    <livewire:contact-modal />

    @livewireScripts
</body>
</html>
