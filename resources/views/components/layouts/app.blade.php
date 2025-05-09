<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'metacompress' }}</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mx-auto">
        <div class="mx-auto max-w-2xl px-6 lg:px-8 pb-8">
            <div id="mc_hero" class="pt-8 md:pt-12 pb-4">
                <h1 class="text-2xl sm:text-4xl text-center font-semibold p-4 bg-primary text-white rounded-sm">metacompress</h1>
                <p class="mt-2 text-lg font-medium text-pretty text-primary-content sm:text-xl/8">
                    Image compression and conversion.
                    <span class="block text-xs font-bold">*for personal use and testing. results are not guaranteed. use at your own discretion.*</span>
                </p>
            </div>
            {{ $slot }}
            <nav class="navbar bg-base-200 flex flex-row flex-wrap gap-4 mt-4 rounded-lg">
                <a class="link-primary hover:link-hover font-semibold text-sm" wire:current.exact='text-white' wire:navigate  href="/">
                    Home
                </a>
                <a class="link-primary hover:link-hover font-semibold text-sm" wire:current='text-white' wire:navigate  href="/privacy">
                    Privacy
                </a>
                <span class="text-slate-400 opacity-75 text-xs ml-auto">feedback@mail.metakimb.dev</span>
            </nav>
        </div>
    </div>
    <x-toaster-hub />
</body>
</html>
