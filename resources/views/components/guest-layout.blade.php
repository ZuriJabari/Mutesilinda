@props(['title' => null])

@php
    $pageTitle = $title ?? 'Mutesilinda';
@endphp

@include('layouts.app', [
    'title' => $pageTitle,
    'slot' => new \Illuminate\Support\HtmlString(
        '<div class="pt-28 md:pt-32 pb-16 px-4 sm:px-6 lg:px-8">'
        .'<div class="max-w-md mx-auto">'
        .'<div class="bg-white border border-gray-200/70 rounded-2xl shadow-2xl shadow-gray-900/5 p-8">'
        .(string) $slot
        .'</div>'
        .'</div>'
        .'</div>'
    ),
])
