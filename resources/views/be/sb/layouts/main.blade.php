@include(config('app.be_layout').'.head')
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    @include(config('app.be_layout').'.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        @include(config('app.be_layout').'.topbar')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          @yield('content')
        </div>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>{{ setting('copyright') }}</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  @include(config('app.be_layout').'.modal')
  @include(config('app.be_layout').'.foot')
</body>

</html>
