<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'metacompress' }}</title>
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="preconnect" href="https://cdnjs.cloudflare.com" async>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" async />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container mx-auto">
            <div class="mx-auto max-w-2xl px-6 lg:px-8 pb-8">
                {{ $slot }}
                <nav class="flex flex-row gap-4">
                    <a class="link link-secondary" wire:navigate href="/" :active="request()->routeIs('home')">Home</a>
                    <a class="link link-secondary" wire:navigate href="/faqs" :active="request()->routeIs('faqs')">FAQs</a>
                </nav>
            </div>
        </div>
    </body>
</html>
