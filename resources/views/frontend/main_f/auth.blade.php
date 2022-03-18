<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>@yield('title')</title>

    {{-- style --}}
    {{-- stack untuk menambahkan css dimanapun --}}
    @stack('prepend-style')
    @include('frontend.include_f.style')
    @stack('addon-style')
</head>

  <body>
    
    {{-- navbar --}}
    @include('frontend.include_f.navbar-auth')

    <!-- page content -->
    @yield('content')

    <!-- footer -->
    @include('frontend.include_f.footer')

    <!-- script -->
    @stack('prepend-script')
    @include('frontend.include_f.script')
    @stack('addon-script')
  </body>
</html>
