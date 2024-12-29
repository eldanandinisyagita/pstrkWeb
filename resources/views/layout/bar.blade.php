<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>navbar</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon">
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="../assets/css/style.css" rel="stylesheet">

    </head>

    <body>
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">
            <div class="d-flex align-items-center justify-content-between">
                <a href="index.html" class="logo d-flex align-items-center">
                    <img src="assets/img/logoTRK.png" alt="">
                    <span class="d-none d-lg-block">PSTRK</span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn" ></i>
            </div><!-- End Logo -->

            <h1 class="d-flex align-items-center text-dark fw-bolder fs-4 my-1 ms-4" >@yield('judul_header')
        </header><!-- End Header -->

        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="/dashboard">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="/dosen">
                      <i class="bi bi-person"></i>
                      <span>Dosen</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="/kurikulum">
                      <i class="bi bi-folder"></i>
                      <span>Kurikulum</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="/jenis_konten">
                      <i class="bi bi-list-task"></i>
                      <span>Jenis Konten</span>
                    </a>
                </li>

                <li class="nav-item"> <!--konten-->
                    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Konten</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/berita">
                                <i class="bi bi-circle"></i><span>Berita</span>
                            </a>
                        </li>
                        <li>
                            <a href="/prestasi">
                                <i class="bi bi-circle"></i><span>Prestasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="/kegiatan">
                                <i class="bi bi-circle"></i><span>Kegiatan</span>
                            </a>
                        </li>
                        <li>
                            <a href="/akreditasi">
                                <i class="bi bi-circle"></i><span>Akreditasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="/alumni">
                                <i class="bi bi-circle"></i><span>Prospek Alumni</span>
                            </a>
                        </li>
                        <li>
                            <a href="/profil">
                                <i class="bi bi-circle"></i><span>Profil Singkat</span>
                            </a>
                        </li>
                        <li>
                            <a href="/fasilitas">
                                <i class="bi bi-circle"></i><span>Fasilitas</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item"> <!--pesan-->
                    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-chat-square-text"></i><span>Pesan</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/pesan">
                                <i class="bi bi-circle"></i><span>Pesan Masuk</span>
                            </a>
                        </li>
                        <li>
                            <a href="/faq">
                                <i class="bi bi-circle"></i><span>FAQ</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item"> <!--hima-->
                    <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-journal-text"></i><span>HIMA</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/hima">
                                <i class="bi bi-circle"></i><span>Info Hima</span>
                            </a>
                        </li>
                        <li>
                            <a href="/kabinet">
                                <i class="bi bi-circle"></i><span>Kabinet</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item"> <!--galeri-->
                    <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-card-image"></i><span>Galeri</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/photo">
                                <i class="bi bi-circle"></i><span>Foto</span>
                            </a>
                        </li>
                        <li>
                            <a href="/video">
                                <i class="bi bi-circle"></i><span>Video</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="/agenda">
                      <i class="bi bi-calendar-week"></i>
                      <span>Agenda</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="/kontak">
                      <i class="bi bi-person-lines-fill"></i>
                      <span>Kontak</span>
                    </a>
                </li>
                <hr>

                <!-- Additional social media and logout links -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#">
                      <i class="bi bi-whatsapp"></i>
                      <span>WhatsApp</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="https://www.instagram.com/pstrk_hebat?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank">
                      <i class="bi bi-instagram"></i>
                      <span>Instagram</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="https://www.youtube.com/@pstrkhebat2036" target="_blank">
                      <i class="bi bi-youtube"></i>
                      <span>YouTube</span>
                    </a>
                </li>
                <hr>

                <li class="nav-item"> <!--galeri-->
                    <a class="nav-link collapsed" data-bs-target="#sip-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-archive"></i><span>Arsip</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="sip-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/arsipdosen">
                                <i class="bi bi-circle"></i><span>Arsip Dosen</span>
                            </a>
                        </li>
                        <li>
                            <a href="/arsipkonten">
                                <i class="bi bi-circle"></i><span>Arsip Konten</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="/logout">
                      <i class="bi bi-box-arrow-right"></i>
                      <span>Logout</span>
                    </a>
                </li>
                <!-- End of additional social media and logout links -->
            </ul>
        </aside>
        <!-- End Sidebar-->

        <!-- Vendor JS Files -->
        <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/chart.js/chart.umd.js"></script>
        <script src="assets/vendor/echarts/echarts.min.js"></script>
        <script src="assets/vendor/quill/quill.js"></script>
        <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="../assets/js/main.js"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </body>
</html>
