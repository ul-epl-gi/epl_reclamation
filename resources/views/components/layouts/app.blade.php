<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'Ue list' }}</title>
        <script src="https://telegram.org/js/telegram-web-app.js"></script>
        @vite('resources/css/app.css')
    </head>
    <body class="overflow-hidden">
        {{ $slot }}
    </body>
</html>
