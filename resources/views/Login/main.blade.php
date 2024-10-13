<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{$tittle}} @if(isset($subtit)) - {{$subtit}} @endif</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{url('img/favicon.png')}}" rel="icon">
  <link href="{{url('img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{url('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{url('vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{url('vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{url('vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{url('vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{url('vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{url('css/style.css')}}" rel="stylesheet">
  <link href="{{url('css/gmustyles.css')}}" rel="stylesheet">


    <!--  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <!-- SELECT2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- MULTISELECT -->
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css">
    <script src="{{ url('js/multiple-select.min.js')}}"></script>
    <!-- SWAL -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- MASK -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <!-- MORRIS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <!-- BUTTONS DATATABLE  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.2/b-2.3.4/b-colvis-2.3.4/b-html5-2.3.4/b-print-2.3.4/datatables.min.css"/>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.2/b-2.3.4/b-colvis-2.3.4/b-html5-2.3.4/b-print-2.3.4/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.13.4/api/sum().js"></script>


    {{-- BACKGROUNDS ANIMADOS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js"></script>

    <!--  -->
    <!--  -->
    <script src="{{ url('js/funciones.js')}}"></script>
</head>

<body class="toggle-sidebar">
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
    <i class="bi bi-list toggle-sidebar-btn"></i>
    &nbsp;&nbsp;
      <a href="{{ route('index') }}" class="logo d-flex align-items-center">
        <img src="{{url('img/logo.png')}}" alt="">
        <img src="{{url('img/text-logo.png')}}" alt="">
        {{-- <span class="d-none d-lg-block">NiceAdmin</span> --}}
      </a>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown">
          <a class="nav-link nav-icon" style="cursor:pointer" onclick="agregarServicioMain();" data-bs-toggle="dropdown">
            <i class="ri-money-dollar-box-line"></i>
          </a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link nav-icon" style="cursor:pointer" onclick="agregarClienteMain();" data-bs-toggle="dropdown">
            <i class="bi bi-person-plus"></i>
          </a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link nav-icon" style="cursor:pointer" onclick="agregarInvitadoMain();" data-bs-toggle="dropdown">
            <i class="bi bi-people"></i>
          </a>
        </li>

        @include('Login.getAlertas')

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            @if(existeArchivo('assets/administrativos', Session::get('Sid') . '.png'))
                    <img src="assets/administrativos/{{Session::get('Sid')}}.png?v={{ date('mdHis') }}" alt="Profile" class="rounded-circle">
                @else
                    <img src="img/usuario-vacio.png" alt="Profile" class="rounded-circle">
                @endif
            <span class="d-none d-md-block dropdown-toggle ps-2">{{Session::get('Sname')}}</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            {{-- <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>Web Designer</span>
            </li> --}}

            <li>
              <a class="dropdown-item d-flex align-items-center" style="cursor: pointer;" onclick="editarPerfil()">
                <i class="bi bi-person"></i>
                <span>Mi Perfil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('closesesion') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Salir</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('index') }}" id="dashINICIO">
          <i class="ri-home-2-line"></i>
          <span>INICIO</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('servicios') }}" id="dashSERVICIOS">
          <i class="ri-lifebuoy-line"></i>
          <span>SERVICIOS</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('clientes') }}" id="dashCLIENTES">
          <i class="ri-user-line"></i>
          <span>CLIENTES</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#chart-REPORTES" data-bs-toggle="collapse" href="" id="dashREPORTES">
          <i class="ri-git-repository-line"></i>
          <span>REPORTES</span>
        </a>
        <ul id="chart-REPORTES" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a id="cMembresias" href="{{ route('reporteMembresias') }}">
              <i class="bi bi-circle"></i><span>Membresias</span>
            </a>
          </li>
          <li>
            <a id="cCorte" href="{{ route('reporteCorte') }}">
              <i class="bi bi-circle"></i><span>Corte</span>
            </a>
          </li>
          <li>
            <a id="cPendientes" href="{{ route('reportePendientes') }}">
              <i class="bi bi-circle"></i><span>Pendientes</span>
            </a>
          </li>
        </ul>
      </li>

      @if(Session::get('Stipo') == 1)
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('administrativos') }}" id="dashADMINISTRATIVOS">
          <i class="ri-bookmark-3-line"></i>
          <span>ADMINISTRATIVOS</span>
        </a>
      </li>
      @endif

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
        <section class="wrapper">
            <div class="top">{{$tittle}} @if(isset($subtit)) - {{$subtit}} @endif</div>
            <div class="bottom" aria-hidden="true">{{$tittle}} @if(isset($subtit)) - {{$subtit}} @endif</div>
        </section>
      </div>

      <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">

                <!-- Table with stripped rows -->
                @yield('contenido')
                <!-- End Table with stripped rows -->

              </div>
            </div>
              {{-- --------------------------------------------------------------------------------------------------------------------- --}}
              {{--  --}}
              <div class="modal fade" id="modaleditarPerfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content">
                    {{--  --}}
                    <div id="modaleditarPerfilBody">

                    </div>
                    {{--  --}}
                  </div>
                </div>
              </div>
              {{--  --}}
              {{--  --}}
              <div class="modal fade" id="modalagregarClienteMain" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        {{--  --}}
                        <div id="modalagregarClienteMainBody">

                        </div>
                        {{--  --}}
                    </div>
                </div>
              </div>
              {{--  --}}
              {{--  --}}
              <div class="modal fade" id="modalagregarInvitadoMain" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        {{--  --}}
                        <div id="modalagregarInvitadoMainBody">

                        </div>
                        {{--  --}}
                    </div>
                </div>
              </div>
              {{--  --}}
              {{--  --}}
              <div class="modal fade" id="modalagregarServicioMain" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        {{--  --}}
                        <div id="modalagregarServicioMainBody">

                        </div>
                        {{--  --}}
                    </div>
                </div>
              </div>
              {{--  --}}
              {{--  --}}
              <div class="modal fade" id="modalverNotificacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        {{--  --}}
                        <div id="modalverNotificacionBody">

                        </div>
                        {{--  --}}
                    </div>
                </div>
              </div>
              {{--  --}}
              {{--  --}}
              <div class="modal fade" id="modalrevisarMembresias" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        {{--  --}}
                        <div id="modalrevisarMembresiasBody">

                        </div>
                        {{--  --}}
                    </div>
                </div>
              </div>
              {{--  --}}
              {{--  --}}
              {{-- --------------------------------------------------------------------------------------------------------------------- --}}
          </div>
        </div>
      </section>

  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{url('vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{url('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{url('vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{url('vendor/quill/quill.min.js')}}"></script>
  {{-- <script src="{{url('vendor/simple-datatables/simple-datatables.js')}}"></script> --}}
  <script src="{{url('vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{url('vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{url('js/main.js')}}"></script>

  @php
    if(isset($chart)){
      echo "<script> var chartA = '{$chart}' </script>";
    }else{
      echo "<script> var chartA = null </script>";
    }
  @endphp

  <script type="text/javascript">
    var tittle = '{{$tittle}}';

    function editarPerfil(){
        $.ajax({
            data: { _token: "{{ csrf_token() }}" },
            type : "GET",
            url : "{{route('editarPerfil')}}",
            beforeSend : function () {
                $("#modaleditarPerfilBody").html('{{Html::image('img/loading.gif', 'CARGANDO ESPERE', ['class' => 'center-block'])}}');
            },
            success:  function (response) {
                $('#modaleditarPerfil').modal({backdrop: 'static',keyboard: false});
                $('#modaleditarPerfil').modal('show');
                $("#modaleditarPerfilBody").html(response);
            },
            error: function(error) {
                swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
            }
        });
    }

    function agregarClienteMain(){
        $.ajax({
            data: { _token: "{{ csrf_token() }}" },
            type : "GET",
            url : "{{route('agregarClienteMain')}}",
            beforeSend : function () {
                $("#modalagregarClienteMainBody").html('{{Html::image('img/loading.gif', 'CARGANDO ESPERE', ['class' => 'center-block'])}}');
            },
            success:  function (response) {
                $('#modalagregarClienteMain').modal({backdrop: 'static',keyboard: false});
                $('#modalagregarClienteMain').modal('show');
                $("#modalagregarClienteMainBody").html(response);
            },
            error: function(error) {
                swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
            }
        });
    }

    function agregarInvitadoMain(){
        $.ajax({
            data: { _token: "{{ csrf_token() }}" },
            type : "GET",
            url : "{{route('agregarInvitadoMain')}}",
            beforeSend : function () {
                $("#modalagregarInvitadoMainBody").html('{{Html::image('img/loading.gif', 'CARGANDO ESPERE', ['class' => 'center-block'])}}');
            },
            success:  function (response) {
                $('#modalagregarInvitadoMain').modal({backdrop: 'static',keyboard: false});
                $('#modalagregarInvitadoMain').modal('show');
                $("#modalagregarInvitadoMainBody").html(response);
            },
            error: function(error) {
                swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
            }
        });
    }

    function agregarServicioMain(){
        $.ajax({
            data: { _token: "{{ csrf_token() }}" },
            type : "GET",
            url : "{{route('agregarServicioMain')}}",
            beforeSend : function () {
                $("#modalagregarServicioMainBody").html('{{Html::image('img/loading.gif', 'CARGANDO ESPERE', ['class' => 'center-block'])}}');
            },
            success:  function (response) {
                $('#modalagregarServicioMain').modal({backdrop: 'static',keyboard: false});
                $('#modalagregarServicioMain').modal('show');
                $("#modalagregarServicioMainBody").html(response);
            },
            error: function(error) {
                swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
            }
        });
    }

    revisarAlertas();
    function revisarAlertas(){
        $.ajax({
            data: { _token: "{{ csrf_token() }}" },
            type : "GET",
            url : "{{route('revisarAlertas')}}",
            beforeSend : function () {
            },
            success:  function (response) {
              if(response == 1){
                location.reload();
              }
            },
            error: function(error) {
            }
        });
    }

    $('#dash'+tittle).removeClass("collapsed");
    $('#chart-'+tittle).addClass("show");
    $('#'+chartA).addClass("active");

//     const tl = gsap.timeline();

// const Line = ($el) => {
//   const $paths = $el.querySelectorAll(".path");
//   const tl = gsap.timeline();
//   const duration = gsap.utils.random(40, 80);
//   const y = gsap.utils.random(-250, 250);
//   const rotate = gsap.utils.random(-20, 20);
//   const scaleXFrom = gsap.utils.random(2, 2.5);
//   const scaleXTo = gsap.utils.random(1.5, 1.75);
//   const scaleYFrom = gsap.utils.random(1.5, 2);
//   const scaleYTo = gsap.utils.random(0.6, 0.7);
//   const opacityFrom = gsap.utils.random(0.75, 0.8);
//   const opacityTo = gsap.utils.random(0.85, 1);
//   const ease = gsap.utils.random([
//     "power2.inOut",
//     "power3.inOut",
//     "power4.inOut",
//     "sine.inOut"
//   ]);
//   tl.to($paths, {
//     xPercent: -100,
//     duration: duration,
//     ease: "none",
//     repeat: -1
//   });

//   tl.fromTo(
//     $el,
//     {
//       y,
//       opacity: opacityFrom,
//       rotate,
//       scaleY: scaleYFrom,
//       scaleX: scaleXFrom,
//       transformOrigin: "50% 50%"
//     },
//     {
//       y: y * -1,
//       opacity: opacityTo,
//       rotate: rotate * -1,
//       scaleY: scaleYTo,
//       scaleX: scaleXTo,
//       repeat: -1,
//       yoyo: true,
//       yoyoEase: ease,
//       duration: duration * 0.25,
//       ease: ease,
//       transformOrigin: "50% 50%"
//     },
//     0
//   );

//   tl.seek(gsap.utils.random(10, 20));
// };

// gsap.utils.toArray(".g").forEach(($el) => Line($el));
// gsap.to("svg", { opacity: 1, duration: 1 });

  </script>
</body>

</html>
