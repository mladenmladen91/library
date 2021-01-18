<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('page_description', $page_description ?? '')" />
    <meta name="author" content="">

    <title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>
    <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />

    <!-- Custom fonts for this template-->
    <link href="/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/vendor/startbootstrap-sb-admin-2/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- Main Quill library -->
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    <style>
        button,
        a {
            font-family: Arial, Helvetica, sans-serif;
        }

        .btn {
            min-height: 37px !important;
            padding-top: 7px !important;
            padding-bottom: 7px !important;
            padding-left: 10px !important;
            padding-right: 10px !important;
        }

        .btn-info,
        .btn-primary {
            background-color: #069447 !important;
        }

        .btn-danger {
            background-color: #ff3d00 !important;
        }

        td {
            color: #434343;
            font-size: 16px;
        }

        .sidebar ul {
            list-style-type: none;
        }

        .sidebar li a {
            font-size: 12px !important;
            text-decoration: none;
        }

        .collapse li {
            margin-top: 15px;
        }

        table {
            width: 100% !important;
        }

        @media(max-width: 600px) {
            table {
                width: 700px !important;
                overflow-x: scroll;
            }

            #accordionSidebar li {
                padding-left: 3px !important;
            }

            #accordionSidebar li span {
                padding-left: 5px !important;
            }

            .collapse {
                padding-left: 10px !important;
            }
        }
    </style>


    {{-- Includable CSS --}}
    {{-- @yield('styles')--}}
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @yield('', View::make('component.menu'))

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <span>@yield('title', $page_title ?? '')</span>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">



                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            @yield('', View::make('component.userinfo'))
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                @yield('content', "")

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Flex CMS 2020</span>
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

    <div class="modal fade" id="flexConfirmationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" data-title></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" data-content></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Otkazi</button>
                    <button class="btn btn-primary" data-confirmation-success>Potvrdi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery.easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/vendor/startbootstrap-sb-admin-2/js/sb-admin-2.min.js"></script>
    <script src="/js/flex.js"></script>

    {{-- Includable JS --}}
    @yield('scripts')
</body>

</html>