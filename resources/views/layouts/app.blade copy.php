<!DOCTYPE html>
<html lang="th">

<head>

    {!! SEO::generate() !!}

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

</head>

<body>

    @yield('content')

</body>

</html>
