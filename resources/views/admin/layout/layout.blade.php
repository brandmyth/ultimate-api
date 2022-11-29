<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>eCommerce Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ url('admin/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ url('admin/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ url('admin/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ url('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ url('admin/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('admin/js/select.dataTables.min.css') }}">
  <link rel="stylesheet" href="{{ url('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ url('admin/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <!-- Datatables -->
  <link rel="stylesheet" href="{{ url('admin/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ url('admin/css/dataTables.bootstrap4.min.css') }}">
  <!-- Custom css -->
  <link rel="stylesheet" href="{{ url('admin/css/custom.css') }}">

  <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


            <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        
        <script>
             tinymce.init({
               selector: 'textarea#description', });
        </script>

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('admin.layout.header')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.layout.sidebar')
      <!-- partial -->
      @yield('content')
      <!-- main-panel ends -->

    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ url('admin/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ url('admin/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ url('admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ url('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ url('admin/js/dataTables.select.min.js') }}"></script>
  
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ url('admin/js/off-canvas.js') }}"></script>
  <script src="{{ url('admin/js/hoverable-collapse.js') }}"></script>
  <script src="{{ url('admin/js/template.js') }}"></script>
  <script src="{{ url('admin/js/settings.js') }}"></script>
  <script src="{{ url('admin/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ url('admin/js/dashboard.js') }}"></script>
  <script src="{{ url('admin/js/Chart.roundedBarCharts.js') }}"></script>
  <!-- End custom js for this page-->
  <!-- Confirm Deletation -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- End Confirm Deletation -->
  <!-- Custom Admin js-->
  <script src="{{ url('admin/js/custom.js') }}"></script>
  <!-- End custom Admin js -->
  


  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js" integrity="sha512-BmM0/BQlqh02wuK5Gz9yrbe7VyIVwOzD1o40yi1IsTjriX/NGF37NyXHfmFzIlMmoSIBXgqDiG1VNU6kB5dBbA==" crossorigin="anonymous"></script>
    
  @stack('scripts')
</body>

</html>

