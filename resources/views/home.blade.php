<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-900">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <title>SigmaGem Consign</title>
</head>

<body class="h-full">

    <x-navbar></x-navbar>

    <!-- Section untuk menampilkan kategori tanpa background -->
    <div class="flex space-x-2 overflow-hidden mt-3 ml-4"> <!-- Tambahkan mt-4 untuk jarak atas, ml-4 untuk jarak kiri -->
    @foreach ($categories as $category)
        <a href="/product/{{ $category->list_kategori }}"
            class="text-base font-semibold text-gray-200 px-4 py-2 rounded-md transition duration-200 ease-in-out transform hover:scale-105 hover:bg-gray-700 hover:text-white focus:bg-gray-700 focus:text-white">
            {{ $category->list_kategori }}
        </a>
    @endforeach
</div>




</body>

</html>
