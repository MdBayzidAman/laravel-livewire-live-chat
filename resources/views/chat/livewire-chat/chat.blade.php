<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LiveWire chat</title>
    @livewireStyles
    <!-- Tailwind  -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Chat theme css -->
    <link rel="stylesheet" href="{{ asset('css/chat-theme/app.css') }}">
</head>

<body>

    <livewire:chat />

    @livewireScripts

    <!-- Chat theme js -->
    <script src="{{ asset('js/chat-theme/app.js') }}"></script>
</body>

</html>