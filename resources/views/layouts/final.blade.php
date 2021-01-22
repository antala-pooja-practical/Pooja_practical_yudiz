@include('layouts.header')

<body>
  @include('layouts.menu')
  <div class="page" id="app">
      @yield('content')
  </div>
  @include('layouts.footer')
  @include('layouts.js')
</body>

</html>
