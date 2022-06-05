<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" href="{{ asset('') }}backend/images/favicon.ico">
      <title>Market - Dashboard</title>
      <!-- Vendors Style-->
      <link rel="stylesheet" href="{{ asset('') }}backend/css/vendors_css.css">
      <!-- Style-->  
      <link rel="stylesheet" href="{{ asset('') }}backend/css/style.css">
      <link rel="stylesheet" href="{{ asset('') }}backend/css/skin_color.css">
      <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      
   </head>
   <body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
      <script type="text/javascript">
         $(document).on('click', 'a[ajax_load]', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
              url: url,
              context: document.body
            }).done(function(data) {
               if (data.status == 200) {
                  $('.full_main_container').html(data.html);
                  window.history.pushState({state:'new'},'', data.url);
               }
            });
         });
         $(window).on("popstate", function (e) {
            location.reload();
         });

         function AddAlert(type,message) {
            return "<div class='alert alert-"+type+"' role='alert'>"+message+"</div>";
         }
      </script>
      <div class="wrapper">
         @include('admin.main.header')
         <!-- Left side column. contains the logo and sidebar -->
         @include('admin.main.sidebar')
         <div class="full_main_container">
            @yield('admin')
         </div>
         @include('admin.main.footer')
      </div>
      <!-- ./wrapper -->
      <!-- Vendor JS -->
      <script src="{{ asset('') }}backend/js/vendors.min.js"></script>
      <script src="{{ asset('') }}assets/icons/feather-icons/feather.min.js"></script>  
      <script src="{{ asset('') }}assets/vendor_components/easypiechart/dist/jquery.easypiechart.js"></script>
      <script src="{{ asset('') }}assets/vendor_components/apexcharts-bundle/irregular-data-series.js"></script>
      <script src="{{ asset('') }}assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
      <!-- Sunny Admin App -->
      <script src="{{ asset('') }}backend/js/template.js"></script>
      <script src="{{ asset('') }}backend/js/pages/dashboard.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </body>
</html>