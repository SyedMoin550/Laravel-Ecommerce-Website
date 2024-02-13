<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    {{-- Boostrap CDN  --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- Bootstrap Icon CDN  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- MyStyle Css  --}}
    <link rel="stylesheet" href={{ asset('css/style.css') }}>


    {{-- Exzoom link prod image --}}
    <link rel="stylesheet" href={{ asset('exzoom/jquery.exzoom.css') }}>

    {{-- Alertify  --}}
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />


    @livewireStyles

    <title>@yield('title')</title>
</head>
{{-- style="background: var(--bgColor)"  --}}

<body class="">
    {{-- Navbar  --}}
    @include('Layout.navbar')

    @yield('content')

    {{-- Footer  --}}
    @include('Layout.footer')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    {{-- exZoom Script  --}}
    <script src="{{ asset('exzoom/jquery.exzoom.js') }}"></script>

    @livewireScripts

    @yield('scripts')

    <script>
        // document.addEventListener('update-item', event => {
        //    alert( 'Date updated to: ' + event.detail.date + 'on item with id of ' + event.detail.item );
        // })
        

    </script>

</body>

</html>
