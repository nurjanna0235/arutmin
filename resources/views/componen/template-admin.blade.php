<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dokumen-ARUTMIN ASAM-ASAM</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/template-admin/assets/img/favicon.png" rel="icon">
    <link href="/template-admin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    

    <!-- Vendor CSS Files -->
    <link href="/template-admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <lintemplate-admin href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="/template-admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="/template-admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="/template-admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="/template-admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="/template-admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="/template-admin/assets/css/style.css" rel="stylesheet">


        <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-/template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="template-admin/assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">ARUTMIN</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                
                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="/img/profile.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ session('username') }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ session('username') }}</h6>
                            <span>{{ session('level') }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="/admin/profile">
                                <i class="bi bi-person"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="/logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav>


    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/beranda') ? '' : 'collapsed' }}"
                    href="/beranda">
                    <i class="ri-home-fill"></i>
                    <span>Beranda</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/pengguna') ? '' : 'collapsed' }}"
                    href="/admin/pengguna">
                    <i class="ri-user-fill"></i>
                    <span>Pengguna</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('rate-contract') ? '' : 'collapsed' }}"
                    href="/rate-contract">
                    <i class="ri-article-fill"></i>
                    <span>Kontraktor</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('logout') ? '' : 'collapsed' }}"
                    href="/logout">
                    <i class="ri-article-fill"></i>
                    <span>Logout</span>
                </a>
            </li>


        </ul>
    </aside><!-- End Sidebar-->
    <!-- Content -->
    @yield('conten')
    <!-- End Content -->



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="template-admin/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="template-admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="template-admin/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="template-admin/assets/vendor/echarts/echarts.min.js"></script>
    <script src="template-admin/assets/vendor/quill/quill.js"></script>
    <script src="template-admin/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="template-admin/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="template-admin/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="template-admin/assets/js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
