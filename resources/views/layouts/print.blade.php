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
</head>

<body class="font-sans antialiased">
    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
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