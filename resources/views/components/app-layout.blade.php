@props(['title' => null])

@php
    $pageTitle = $title ?? 'Dashboard - Mutesilinda';
    $headerHtml = isset($header)
        ? '<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 md:pt-28 pb-6">'.trim((string) $header).'</div>'
        : '';
    $slotHtml = $headerHtml.(string) $slot;
@endphp

@include('layouts.app', [
    'title' => $pageTitle,
    'slot' => new \Illuminate\Support\HtmlString($slotHtml),
])
