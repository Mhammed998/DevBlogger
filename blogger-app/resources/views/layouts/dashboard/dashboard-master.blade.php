<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

    <title> @yield('backend-title') </title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="{{ asset('assets/css/material-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
   {{-- select2 plugin --}}
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   {{-- custom styles --}}
   <link rel="stylesheet" href="{{ asset('assets/css/custom-style.css') }}"/>
   @yield('backend-styles')

    <!-- Scripts -->
{{--     @vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
</head>
<body>

    <div class="dashboard dark-edition">
       <div class="wrapper">

        <div class="sidebar" data-color="purple" data-background-color="black" data-image="{{ asset('assets/img/sidebar-2.jpg') }}">
            <!--
              Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

              Tip 2: you can also add an image using data-image tag
          -->
            <div class="logo">
              <a href="/" class="simple-text logo-normal">
                Admin Panel
              </a>
            </div>
            <div class="sidebar-wrapper">
              <ul class="nav">
                <li class="nav-item {{isLinkActive('main')}}  ">
                  <a class="nav-link" href="/dashboard/main">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                  </a>
                </li>
                <li class="nav-item {{isLinkActive('users')}} ">
                  <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="material-icons">people</i>
                    <p>Users</p>
                  </a>
                </li>
                <li class="nav-item {{isLinkActive('categories')}} ">
                  <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="material-icons">library_books</i>
                    <p>Categories</p>
                  </a>
                </li>
                <li class="nav-item {{isLinkActive('posts')}}">
                  <a class="nav-link" href="{{route('posts.index')}}">
                    <i class="material-icons">content_paste</i>
                    <p>Posts</p>
                  </a>
                </li>
                <li class="nav-item {{isLinkActive('tags')}} ">
                  <a class="nav-link" href="{{ route('tags.index') }}">
                    <i class="material-icons">tags</i>
                    <p>Tags</p>
                  </a>
                </li>
                <li class="nav-item {{isLinkActive('comments')}}">
                  <a class="nav-link" href="{{ route('comments.index') }}">
                    <i class="fa fa-comments"></i>
                    <p>Comments</p>
                  </a>
                </li>

                <li class="nav-item {{isLinkActive('roles')}}">
                  <a class="nav-link" href="{{ route('roles.index') }}">
                    <i class="material-icons">lock</i>
                    <p>Roles & Permisions</p>
                  </a>
                </li>


                <li class="nav-item {{isLinkActive('settings')}} ">
                    <a class="nav-link" href="">
                      <i class="fa fa-cog"></i>
                      <p>Settings</p>
                    </a>
                  </li>


              </ul>
            </div>
          </div>



          <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
              <div class="container-fluid">
                <div class="navbar-wrapper">
                  <a class="navbar-brand" href="javascript:void(0)">Dashboard</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="navbar-toggler-icon icon-bar"></span>
                  <span class="navbar-toggler-icon icon-bar"></span>
                  <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                  {{-- <form class="navbar-form">
                    <div class="input-group no-border">
                      <input type="text" value="" class="form-control" placeholder="Search...">
                      <button type="submit" class="btn btn-default btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                      </button>
                    </div>
                  </form> --}}
                  <ul class="navbar-nav">
                    {{-- <li class="nav-item">
                      <a class="nav-link" href="dashboard/main">
                        <i class="material-icons">dashboard</i>
                        <p class="d-lg-none d-md-block">
                          Stats
                        </p>
                      </a>
                    </li> --}}
                    {{-- <li class="nav-item dropdown">
                      <a class="nav-link" href="javscript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">notifications</i>
                        <span class="notification">5</span>
                        <p class="d-lg-none d-md-block">
                          Some Actions
                        </p>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="javascript:void(0)">Mike John responded to your email</a>
                        <a class="dropdown-item" href="javascript:void(0)">You have 5 new tasks</a>
                        <a class="dropdown-item" href="javascript:void(0)">You're now friend with Andrew</a>
                        <a class="dropdown-item" href="javascript:void(0)">Another Notification</a>
                        <a class="dropdown-item" href="javascript:void(0)">Another One</a>
                      </div>
                    </li> --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link d-flex justify-content-between " href="javscript:void(0)" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">person</i>
                            <p class="d-md-block">
                              {{ auth()->user()->name }}
                            </p>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink2">
                            <a class="dropdown-item" href="{{ route('account-profile.show') }}">
                               <i class="fa fa-cog mr-1"></i> Account settings
                            </a>
                            <a class="dropdown-item" href="/">
                              <i class="fa fa-globe mr-1"></i> Visit website
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             <i class="fa fa-sign-out"></i> {{__('Logout') }}
                         </a>

                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                             @csrf
                         </form>


                          </div>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
            <!-- End Navbar -->


                @yield('backend-content')


            <footer class="footer">
              <div class="container-fluid">
                <nav class="float-left">
                  <ul>
                    <li>
                      <a href="">
                        MH
                      </a>
                    </li>


                  </ul>
                </nav>
                <div class="copyright float-right" id="date">
                  , made with <i class="material-icons">favorite</i> by
                  <a href="" target="_blank"> MH</a> for a better web.
                </div>
              </div>
            </footer>
            <script>
              const x = new Date().getFullYear();
              let date = document.getElementById('date');
              date.innerHTML = '&copy; ' + x + date.innerHTML;
            </script>
          </div>

       </div>


    </div>
 <!--   Core JS Files   -->
 <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
 <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
 <script src="{{ asset('assets/js/core/bootstrap-material-design.min.js') }}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="https://unpkg.com/default-passive-events"></script>
 <script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
 <!-- Place this tag in your head or just before your close body tag. -->
 <script async defer src="https://buttons.github.io/buttons.js"></script>
 <!--  Google Maps Plugin    -->
 <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
 <!-- Chartist JS -->
 <script src="{{ asset('assets/js/plugins/chartist.min.js') }}"></script>
 <!--  Notifications Plugin    -->
 <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
 <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
 <script src="{{ asset('assets/js/material-dashboard.js?v=2.1.0') }}"></script>
 <!-- Material Dashboard DEMO methods, don't include it in your project! -->
 <script src="{{ asset('assets/demo/demo.js') }}"></script>
 <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );


</script>
 <script>
   $(document).ready(function() {
     $().ready(function() {
       $sidebar = $('.sidebar');

       $sidebar_img_container = $sidebar.find('.sidebar-background');

       $full_page = $('.full-page');

       $sidebar_responsive = $('body > .navbar-collapse');

       window_width = $(window).width();

       $('.fixed-plugin a').click(function(event) {
         // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
         if ($(this).hasClass('switch-trigger')) {
           if (event.stopPropagation) {
             event.stopPropagation();
           } else if (window.event) {
             window.event.cancelBubble = true;
           }
         }
       });

       $('.fixed-plugin .active-color span').click(function() {
         $full_page_background = $('.full-page-background');

         $(this).siblings().removeClass('active');
         $(this).addClass('active');

         var new_color = $(this).data('color');

         if ($sidebar.length != 0) {
           $sidebar.attr('data-color', new_color);
         }

         if ($full_page.length != 0) {
           $full_page.attr('filter-color', new_color);
         }

         if ($sidebar_responsive.length != 0) {
           $sidebar_responsive.attr('data-color', new_color);
         }
       });

       $('.fixed-plugin .background-color .badge').click(function() {
         $(this).siblings().removeClass('active');
         $(this).addClass('active');

         var new_color = $(this).data('background-color');

         if ($sidebar.length != 0) {
           $sidebar.attr('data-background-color', new_color);
         }
       });

       $('.fixed-plugin .img-holder').click(function() {
         $full_page_background = $('.full-page-background');

         $(this).parent('li').siblings().removeClass('active');
         $(this).parent('li').addClass('active');


         var new_image = $(this).find("img").attr('src');

         if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
           $sidebar_img_container.fadeOut('fast', function() {
             $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
             $sidebar_img_container.fadeIn('fast');
           });
         }

         if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
           var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

           $full_page_background.fadeOut('fast', function() {
             $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
             $full_page_background.fadeIn('fast');
           });
         }

         if ($('.switch-sidebar-image input:checked').length == 0) {
           var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
           var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

           $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
           $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
         }

         if ($sidebar_responsive.length != 0) {
           $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
         }
       });

       $('.switch-sidebar-image input').change(function() {
         $full_page_background = $('.full-page-background');

         $input = $(this);

         if ($input.is(':checked')) {
           if ($sidebar_img_container.length != 0) {
             $sidebar_img_container.fadeIn('fast');
             $sidebar.attr('data-image', '#');
           }

           if ($full_page_background.length != 0) {
             $full_page_background.fadeIn('fast');
             $full_page.attr('data-image', '#');
           }

           background_image = true;
         } else {
           if ($sidebar_img_container.length != 0) {
             $sidebar.removeAttr('data-image');
             $sidebar_img_container.fadeOut('fast');
           }

           if ($full_page_background.length != 0) {
             $full_page.removeAttr('data-image', '#');
             $full_page_background.fadeOut('fast');
           }

           background_image = false;
         }
       });

       $('.switch-sidebar-mini input').change(function() {
         $body = $('body');

         $input = $(this);

         if (md.misc.sidebar_mini_active == true) {
           $('body').removeClass('sidebar-mini');
           md.misc.sidebar_mini_active = false;

           $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

         } else {

           $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

           setTimeout(function() {
             $('body').addClass('sidebar-mini');

             md.misc.sidebar_mini_active = true;
           }, 300);
         }

         // we simulate the window Resize so the charts will get updated in realtime.
         var simulateWindowResize = setInterval(function() {
           window.dispatchEvent(new Event('resize'));
         }, 180);

         // we stop the simulation of Window Resize after the animations are completed
         setTimeout(function() {
           clearInterval(simulateWindowResize);
         }, 1000);

       });
     });
   });
 </script>
 <script>
   $(document).ready(function() {
     // Javascript method's body can be found in assets/js/demos.js
     md.initDashboardPageCharts();

   });



   // select2 works !!
   $(document).ready(function() {

    $('.basic-multiple-for-roles').select2({
        placeholder: 'Select User Roles'

    });


    $('.basic-multiple-for-tags').select2({
        placeholder: 'Select  Tags'
    });


    $('.basic-single-status').select2({
        placeholder: 'Select Status'

    });

    $('.basic-single-category').select2({
        placeholder: 'Select Post Category'

    });

});


 </script>

    @include('sweetalert::alert')

    @yield('backend-scripts')
</body>
</html>
