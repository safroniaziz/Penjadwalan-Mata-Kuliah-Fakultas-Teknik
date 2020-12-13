<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SIBANJIR - Halaman Depan</title>
  <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
  <link href="{{ asset('assets/front/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/front/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/front/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/front/vendor/venobox/venobox.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/front/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/front/vendor/aos/aos.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/front/css/style.css') }}" rel="stylesheet">
  <!-- =======================================================
  * Template Name: Arsha - v2.0.0
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="index.html" style="font-size: 16px !important;">
        <img src="{{ asset('assets/images/logo.png') }}" style="width: "> Penjadwalan Mata Kuliah Fakultas Teknik
      </a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="#hero">Home</a></li>
          {{-- <li>
            <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="venobox btn-watch-video" data-vbtype="video" data-autoplay="true"> Video <i class="icofont-play-alt-2"></i></a>
          </li> --}}

        </ul>
      </nav><!-- .nav-menu -->

      <a href="{{ route('login') }}" target="_blank" class="get-started-btn scrollto">Login</a>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" style="height:10px !important; padding-top:12px !important" class="d-flex align-items-center">

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio" style="padding-top: 30px !important">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-md-4">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top" src="{{ asset('assets/images/dekan.jpg') }}" alt="Card image cap">
              <div class="card-body text-center" style="padding:0px !important;">
                <p class="card-text">
                  <h5>SAFRONI AZIZ</h5>
                  <h6>DEKAN FAKULTAS TEKNIK</h6>
                </p>
              </div>
            </div>  
          </div>
          <div class="col-md-8">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="col-md-12">
                      <div class="alert alert-info">
                          Jdwal Mata Kuliah INFORMATIKA Pada Hari {{ $hari }}
                      </div>
                  </div>
                    <table class="table table-bordered table-hover" id="kelas">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Mata Kuliah</th>
                              <th>Kelas</th>
                              <th>Jam Mulai</th>
                              <th>Jam Selesai</th>
                          </tr>
                      </thead>
                      <tbody>
                          @php
                              $no=1;
                          @endphp
                          @foreach ($informatikas as $informatika)
                              <tr>
                                  <td>{{ $no++ }}</td>
                                  <td>{{ $informatika->nm_matkul }}</td>
                                  <td>{{ $informatika->kelas }}</td>
                                  <td>{{ $informatika->jam_mulai }}</td>
                                  <td>{{ $informatika->jam_selesai }}</td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
                </div>
                <div class="carousel-item">
                  <div class="col-md-12">
                    <div class="alert alert-info">
                        Jdwal Mata Kuliah TEKNIK SIPIL Pada Hari {{ $hari }}
                    </div>
                </div>
                  <table class="table table-bordered table-hover" id="kelas">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Kuliah</th>
                            <th>Kelas</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($sipils as $sipil)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $sipil->nm_matkul }}</td>
                                <td>{{ $sipil->kelas }}</td>
                                <td>{{ $sipil->jam_mulai }}</td>
                                <td>{{ $sipil->jam_selesai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <div class="carousel-item">
                  <div class="col-md-12">
                    <div class="alert alert-info">
                        Jdwal Mata Kuliah TEKNIK MESIN Pada Hari {{ $hari }}
                    </div>
                </div>
                  <table class="table table-bordered table-hover" id="kelas">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Kuliah</th>
                            <th>Kelas</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($mesins as $mesin)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $mesin->nm_matkul }}</td>
                                <td>{{ $mesin->kelas }}</td>
                                <td>{{ $mesin->jam_mulai }}</td>
                                <td>{{ $mesin->jam_selesai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <div class="carousel-item">
                  <div class="col-md-12">
                    <div class="alert alert-info">
                        Jdwal Mata Kuliah TEKNIK ELEKTRO Pada Hari {{ $hari }}
                    </div>
                </div>
                  <table class="table table-bordered table-hover" id="kelas">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Kuliah</th>
                            <th>Kelas</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($elektros as $elektro)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $elektro->nm_matkul }}</td>
                                <td>{{ $elektro->kelas }}</td>
                                <td>{{ $elektro->jam_mulai }}</td>
                                <td>{{ $elektro->jam_selesai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <div class="carousel-item">
                  <div class="col-md-12">
                    <div class="alert alert-info">
                        Jdwal Mata Kuliah SISTEM INFORMASI Pada Hari {{ $hari }}
                    </div>
                </div>
                  <table class="table table-bordered table-hover" id="kelas">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Kuliah</th>
                            <th>Kelas</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($sis as $si)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $si->nm_matkul }}</td>
                                <td>{{ $si->kelas }}</td>
                                <td>{{ $si->jam_mulai }}</td>
                                <td>{{ $si->jam_selesai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <div class="carousel-item">
                  <div class="col-md-12">
                    <div class="alert alert-info">
                        Jdwal Mata Kuliah TEKNIK SIPIL Pada Hari {{ $hari }}
                    </div>
                </div>
                  <table class="table table-bordered table-hover" id="kelas">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Kuliah</th>
                            <th>Kelas</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($sipils as $sipil)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $sipil->nm_matkul }}</td>
                                <td>{{ $sipil->kelas }}</td>
                                <td>{{ $sipil->jam_mulai }}</td>
                                <td>{{ $sipil->jam_selesai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Portfolio Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" style="position:relative;bottom:0;width:100%">


    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Fakultas Teknik</span></strong>. 2020
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        <a target="_blank" href="https://unib.ac.id">UNIVERSITAS BENGKULU</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/front/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/front/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('assets/front/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/front/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('assets/front/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/front/vendor/venobox/venobox.min.js') }}"></script>
  <script src="{{ asset('assets/front/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets/front/vendor/aos/aos.js') }}"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/front/js/main.js') }}"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNUmHx3Et1_3SI2gQOe23vG0olB5cAmkk"></script>
  <script>
    $(document).ready( function () {
        $('#kelas').DataTable();
    } );
</script>
</body>

</html>