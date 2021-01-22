@include('layouts.auth_header')

<body>
  @include('layouts.menu')
  <div class="page">
      @yield('content')
  </div>
  @include('layouts.auth_js')
</body>

</html>
