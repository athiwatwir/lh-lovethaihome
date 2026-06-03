<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {!! SEO::generate() !!}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">


    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

</head>

<body class="max-md:pb-[calc(4.75rem+env(safe-area-inset-bottom))]">

    <div class="antialiased">

        <x-Navbar />
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
            @yield('content')

        </div>


        <x-Footer />
    </div>
</body>
</html>
