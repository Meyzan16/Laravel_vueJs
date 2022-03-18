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

    <title>@yield('title')</title>

    {{-- style --}}
    {{-- stack untuk menambahkan css dimanapun --}}
    @stack('prepend-style')
    @include('frontend.include_f.style')
    @stack('addon-style')
</head>

  <body>
    
    {{-- navbar --}}
    @include('frontend.include_f.navbar')
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
