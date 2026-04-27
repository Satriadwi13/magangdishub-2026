<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'Dashboard Monitoring Multi Titik Lalu Lintas' }}</title>
        <!-- Menggunakan Tailwind CDN karena tidak memakai Node.js/Vite -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-slate-950 font-sans antialiased text-slate-200">
        {{ $slot }}
    </body>
</html>
