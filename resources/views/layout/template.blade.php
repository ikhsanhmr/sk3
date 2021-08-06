<!DOCTYPE html>
<html lang="en">

 @include('layout.header')

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>

    @include('layout.navbar')

    @include('layout.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
           @yield('content')
          </div>

          <div class="section-body">
          </div>
        </section>
      </div>

    </div>
  </div>

  @include('layout.footer')

  @include('layout.js')


  <!-- Page Specific JS File -->
</body>
</html>
