<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css ')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://kit.fontawesome.com/8229886894.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    @livewireStyles

    <!-- Scripts -->
    <script src="./TW-ELEMENTS-PATH/dist/js/index.min.js"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css"></script>


    <link href="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.css" rel="stylesheet">

    <!-- Video.js base CSS -->
    <link href="https://unpkg.com/video.js@7/dist/video-js.min.css" rel="stylesheet" />

    <!-- City -->
    <link href="https://unpkg.com/@videojs/themes@1/dist/city/index.css" rel="stylesheet" />

    <livewire:scripts />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-print-css/css/bootstrap-print.min.css" media="print">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style>
        @media (max-width: 767px) {
            .row {
                margin-left: -5px;
                margin-right: -5px;
            }

            ul.products>[class^="col-"],
            ul.products>[class*="col-"],
            .row>[class^="col-"],
            .row>[class*="col-"] {
                padding-left: 5px;
                padding-right: 5px;
            }
        }

        @media (min-width: 1200px) {

            .auto-clear .az_col-lg-1:nth-child(12n+1),
            .auto-clear .az_col-lg-2:nth-child(6n+1),
            .auto-clear .az_col-lg-15:nth-child(5n+1),
            .auto-clear .az_col-lg-3:nth-child(4n+1),
            .auto-clear .az_col-lg-4:nth-child(3n+1),
            .auto-clear .az_col-lg-6:nth-child(odd) {
                clear: both;
            }
        }

        @media (min-width: 1500px) {

            .auto-clear .col-bg-1:nth-child(12n+1),
            .auto-clear .col-bg-2:nth-child(6n+1),
            .auto-clear .col-bg-15:nth-child(5n+1),
            .auto-clear .col-bg-3:nth-child(4n+1),
            .auto-clear .col-bg-4:nth-child(3n+1),
            .auto-clear .col-bg-6:nth-child(odd) {
                clear: both;
            }
        }

        @media (min-width: 1200px) and (max-width: 1499px) {

            .auto-clear .col-lg-1:nth-child(12n+1),
            .auto-clear .col-lg-2:nth-child(6n+1),
            .auto-clear .col-lg-15:nth-child(5n+1),
            .auto-clear .col-lg-3:nth-child(4n+1),
            .auto-clear .col-lg-4:nth-child(3n+1),
            .auto-clear .col-lg-6:nth-child(odd) {
                clear: both;
            }
        }

        @media (min-width: 992px) and (max-width: 1199px) {

            .auto-clear .az_col-md-1:nth-child(12n+1),
            .auto-clear .az_col-md-2:nth-child(6n+1),
            .auto-clear .az_col-md-15:nth-child(5n+1),
            .auto-clear .az_col-md-3:nth-child(4n+1),
            .auto-clear .az_col-md-4:nth-child(3n+1),
            .auto-clear .az_col-md-6:nth-child(odd),
            .auto-clear .col-md-1:nth-child(12n+1),
            .auto-clear .col-md-2:nth-child(6n+1),
            .auto-clear .col-md-15:nth-child(5n+1),
            .auto-clear .col-md-3:nth-child(4n+1),
            .auto-clear .col-md-4:nth-child(3n+1),
            .auto-clear .col-md-6:nth-child(odd) {
                clear: both;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {

            .auto-clear .az_col-sm-1:nth-child(12n+1),
            .auto-clear .az_col-sm-2:nth-child(6n+1),
            .auto-clear .az_col-sm-15:nth-child(5n+1),
            .auto-clear .az_col-sm-3:nth-child(4n+1),
            .auto-clear .az_col-sm-4:nth-child(3n+1),
            .auto-clear .az_col-sm-6:nth-child(odd),
            .auto-clear .col-sm-1:nth-child(12n+1),
            .auto-clear .col-sm-2:nth-child(6n+1),
            .auto-clear .col-sm-15:nth-child(5n+1),
            .auto-clear .col-sm-3:nth-child(4n+1),
            .auto-clear .col-sm-4:nth-child(3n+1),
            .auto-clear .col-sm-6:nth-child(odd) {
                clear: both;
            }
        }

        @media (min-width: 576px) and (max-width: 767px) {

            .auto-clear .col-xs-1:nth-child(12n+1),
            .auto-clear .col-xs-2:nth-child(6n+1),
            .auto-clear .col-xs-15:nth-child(5n+1),
            .auto-clear .col-xs-3:nth-child(4n+1),
            .auto-clear .col-xs-4:nth-child(3n+1),
            .auto-clear .col-xs-6:nth-child(odd) {
                clear: both;
            }
        }

        @media (max-width: 575px) {

            .auto-clear .col-ts-1:nth-child(12n+1),
            .auto-clear .col-ts-2:nth-child(6n+1),
            .auto-clear .col-ts-15:nth-child(5n+1),
            .auto-clear .col-ts-3:nth-child(4n+1),
            .auto-clear .col-ts-4:nth-child(3n+1),
            .auto-clear .col-ts-6:nth-child(odd) {
                clear: both;
            }
        }

        @media (max-width: 767px) {

            .auto-clear .az_col-xs-1:nth-child(12n+1),
            .auto-clear .az_col-xs-2:nth-child(6n+1),
            .auto-clear .az_col-xs-15:nth-child(5n+1),
            .auto-clear .az_col-xs-3:nth-child(4n+1),
            .auto-clear .az_col-xs-4:nth-child(3n+1),
            .auto-clear .az_col-xs-6:nth-child(odd) {
                clear: both;
            }
        }

        /*footer-device-mobile*/
        .footer-device-mobile {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 999;
            background-color: #fff;
            border-top: 1px solid #eee;
            display: none;
        }

        .footer-device-mobile-item {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

        .footer-device-mobile .wapper {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .footer-device-mobile-item>a {
            display: inline-block;
            padding: 5px 0;
            color: #222;
            line-height: normal;
            font-size: 13px;
        }

        .footer-device-mobile-item>a .icon {
            font-size: 24px;
            display: block;
            position: relative;
            height: 30px;
            line-height: 30px;
        }

        .footer-device-mobile-item.device-cart .count-icon {
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 20px;
            border-radius: 50%;
            color: #ffffff;
            background-color: #cf9163;
            font-weight: 700;
            display: inline-block;
            position: absolute;
            top: 0;
            right: -10px;
            font-size: 12px;
        }

        @media (max-width: 767px) {
            .footer-device-mobile {
                display: block;
            }

            body {
                margin-bottom: 56px;
            }
        }
    </style>

    <link href="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.css" rel="stylesheet">

    <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table-locale-all.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.20.2/dist/extensions/export/bootstrap-table-export.min.js"></script>

    <style>
        .select,
        #locale {
            width: 100%;
        }

        .like {
            margin-right: 10px;
        }

        .notification {

            color: black;
            text-decoration: none;
            position: relative;
            display: inline-block;
            padding: 10px;
        }



        .notification .badge {
            position: absolute;
            top: -10px;
            right: -10px;
            padding: 5px 10px;
            border-radius: 50%;
            color: #FF1E00;
        }
    </style>

</head>

<body class="font-sans antialiased hold-transition sidebar-mini layout-navbar-fixed">
    <div style="position:static ;">
    </div>

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                @can('manage-admingudang')
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="text-sm text-warning">
                            @livewire('suratjalan.count-import')
                        </span>
                    </a>
                </li>
                @endif
            </ul>
            <ul class="navbar-nav ml-auto pr-5">
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                        @else
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                {{ Auth::user()->name }}

                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </span>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </x-jet-dropdown-link>
                        @endif

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    PO HIJAB
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="nav-link">
                                        {{ __('Dashboard') }}
                                    </a>
                                </li>

                                @can('manage-users')
                                <li class="nav-item">
                                    <a href="{{ route('admin.inout.index') }}" :active="request()->routeIs('inout.index.*')" class="nav-link">
                                        {{ __('InoutFoto') }}
                                    </a>
                                </li>
                                @endif


                            </ul>
                        </li>

                        <!--  menu gudang online -->
                        @can('manage-online')
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Surat Jalan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('online.kontrolstok.index') }}" :active="request()->routeIs('kontrolstok.index.*')" class="nav-link">
                                        {{ __('Surat Jalan Masuk') }}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('online.sjonline.index') }}" :active="request()->routeIs('sjonline.index.*')" class="nav-link">
                                        {{ __('Surat Jalan Keluar') }}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('online.gudangonline.index') }}" :active="request()->routeIs('gudangonline.index*')" class="nav-link">
                                        {{ __('Stok Opname') }}
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Gudang Online
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('online.stokpixel') }}" :active="request()->routeIs('stokpixel')" class="nav-link">
                                        {{ __('Pixel') }}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('online.stokklik.index') }}" :active="request()->routeIs('stokklik.index *')" class="nav-link">
                                        {{ __('KLik') }}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('online.stokonlinemakkata.index') }}" :active="request()->routeIs('stokonlinemakkata.index.*')" class="nav-link">
                                        {{ __('Makkata') }}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('online.stokonline.index') }}" :active="request()->routeIs('stokonlinemakkata.index.*')" class="nav-link">
                                        {{ __('Stok Online') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('online.gudangstudio.index') }}" :active="request()->routeIs('gudangstudio.index.*')" class="nav-link">
                                        {{ __('Gudang Studio') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        <!--end  menu gudang online -->


                        @can('manage-admingudang')
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Gudang Pusat (GSP)
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                @can('manage-gudang')
                                <li class="nav-item">
                                    <a href="{{ route('gudang.stok.index') }}" :active="request()->routeIs('gudang.stok.*')" class="nav-link">
                                        {{ __('Tambah Stok') }}
                                    </a>
                                </li>
                                @endif

                                @can('manage-users')
                                <li class="nav-item">
                                    <a href="{{ route('gudang.stok.index') }}" :active="request()->routeIs('gudang.stok.*')" class="nav-link">
                                        {{ __('Tambah Stok') }}
                                    </a>
                                </li>
                                @endif

                                @can('manage-admingudang')
                                <!-- <li class="nav-item">
                                    <a href="{{ route('gudang.stok.index') }}" :active="request()->routeIs('gudang.stok.*')" class="nav-link">
                                        {{ __('List Produksi') }}
                                    </a>
                                </li> -->
                                @endif
                                @can('manage-admingudang')
                                <li class="nav-item">
                                    <a href="{{ route('admingudang.stokout.index') }}" :active="request()->routeIs('admingudang.stokout.*')" class="nav-link">
                                        {{ __('Surat Jalan Keluar') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admingudang.sjonline.index') }}" :active="request()->routeIs('sjonline.index.*')" class="nav-link">
                                        {{ __('Nota Online') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admingudang.stokonline.index') }}" :active="request()->routeIs('stokonline.index.*')" class="nav-link">
                                        {{ __('Stok Online') }}
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admingudang.gudangstudio.index') }}" :active="request()->routeIs('gudangstudio.index.*')" class="nav-link">
                                        {{ __('Gudang Studio') }}
                                    </a>
                                </li>
                                @endif
                                @can('manage-gudang')
                                <li class="nav-item">
                                    <a href="{{ route('gudang.stokout.index') }}" :active="request()->routeIs('gudang.stokout.*')" class="nav-link">
                                        {{ __('Surat Jalan Keluar') }}
                                    </a>
                                </li>
                                @endif

                                <!-- <li class="nav-item">
                                    <a href="{{ route('admingudang.suratjalan.index') }}" :active="request()->routeIs('suratjalan.index.*')" class="nav-link">
                                        {{ __('List Surat Jalan') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admingudang.stokpusat.index') }}" :active="request()->routeIs('stokpusat.index.*')" class="nav-link">
                                        {{ __('Stok GSP') }}
                                    </a>
                                </li> -->


                            </ul>
                        </li> @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">

            </section>

            <!-- Main content -->
            <section class="content">

                <div class="px-lg-2">
                    <div class="px-md-2 px-sm-2 px-lg-0 ">
                        <div class="">
                            <!-- Default box -->
                            <div class="">

                                <div class="">
                                    {{ $slot }}
                                </div>
                                <!-- /.card-body -->

                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.298.22
            </div>
            <strong>Copyright &copy; 2022 Planet Fashion</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-light">
            @livewire('suratjalan.import-side-bar')
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    @livewireScripts
    @livewire('livewire-ui-modal')
    <!-- Alpine v2 -->

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <!-- Alpine v3 -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
        // In your Javascript (external .js resource or <script> tag)
        $('.js-select').select2().on('change', function(e) {
            let livewire = $(this).data('livewire')
            eval(livewire).set('warna', $(this).val());
            theme: "classic"
        });
        $('.js-select-gudang').select2().on('change', function(e) {
            let livewire = $(this).data('livewire')
            eval(livewire).set('gudang_tujuan', $(this).val());
            theme: "classic"
        });
    </script>

    <script>
        window.addEventListener('tambahProduk', () => {
            $('#tambahProduk').modal('hide');
        })
        window.addEventListener('updateProduk', () => {
            $('#tambahProduk').modal('show');
        })

        window.addEventListener('closeUpdateGudang', () => {
            $('#updateGudangOnline').modal('hide');
        })
        window.addEventListener('openUpdateGudang', () => {
            $('#updateGudangOnline').modal('show');
        })

        window.addEventListener('openModalDelete', () => {
            $('#modalformDelete').modal('show');
        })
        window.addEventListener('closeModalDelete', () => {
            $('#modalformDelete').modal('hide');
        })
        window.addEventListener('openModalCartOut', () => {
            $('#tambahCartOut').modal('show');
        })
        window.addEventListener('closeModalCartOut', () => {
            $('#tambahCartOut').modal('hide');
        })

        window.addEventListener('openTambahStokOnline', () => {
            $('#inputStokOnline').modal('show');
        })
        window.addEventListener('closeTambahStokOnline', () => {
            $('#inputStokOnline').modal('hide');
        })

        window.addEventListener('openEditStokOnline', () => {
            $('#editStokOnline').modal('show');
        })
        window.addEventListener('closeEditStokOnline', () => {
            $('#editStokOnline').modal('hide');
        })

        window.addEventListener('openDeskripsiStokOnline', () => {
            $('#deskripsiStokOnline').modal('show');
        })
        window.addEventListener('closeDeskripsiStokOnline', () => {
            $('#deskripsiStokOnline').modal('hide');
        })

        window.addEventListener('openModalRevisi', () => {
            $('#revisiProdukSj').modal('show');
        })
        window.addEventListener('closeModalRevisi', () => {
            $('#revisiProdukSj').modal('hide');
        })

        window.addEventListener('openModalTerima', () => {
            $('#terimaProdukSj').modal('show');
        })
        window.addEventListener('closeModalTerima', () => {
            $('#terimaProdukSj').modal('hide');
        })

        window.addEventListener('opentambahProdukSj', () => {
            $('#tambahProdukSj').modal('show');
        })
        window.addEventListener('closetambahProdukSj', () => {
            $('#tambahProdukSj').modal('hide');
        })

        window.addEventListener('openrevisiSjRetur', () => {
            $('#revisiSjRetur').modal('show');
        })
        window.addEventListener('closerevisiSjRetur', () => {
            $('#revisiSjRetur').modal('hide');
        })

        window.addEventListener('openDetailRevisi', () => {
            $('#detailrevisi').modal('show');
        })
        window.addEventListener('closeDetailRevisi', () => {
            $('#detailrevisi').modal('hide');
        })

        $(document).ready(function() {
            // This event is triggered when the modal is hidden       
            $("#tambahProduk").on('hidden.bs.modal', function() {
                livewire.emit('forcedCloseModal');
            });
        });

        window.addEventListener('closeEditInout', () => {
            $('#editInout').modal('hide');
        })

        window.addEventListener('openEditInout', () => {
            $('#editInout').modal('show');
        })

        window.addEventListener('openDelete', () => {
            $('#modalDelete').modal('show');
        })
        window.addEventListener('closeDelete', () => {
            $('#modalDelete').modal('hide');
        })
        window.addEventListener('closeEditCart', () => {
            $('#editStokCart').modal('hide');
        })
    </script>
    <script src="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.js"></script>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="https://vjs.zencdn.net/7.19.2/video.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type
            });
        });

        window.addEventListener('swal:confirm', event => {
            swal({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.type,
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.livewire.emit('delete', event.detail.id);
                    }
                });
        });
    </script>

</body>

</html>