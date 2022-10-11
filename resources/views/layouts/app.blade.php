<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="https://kit.fontawesome.com/8229886894.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @livewireStyles

    <!-- Scripts -->
    <script src="./TW-ELEMENTS-PATH/dist/js/index.min.js"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css">

    <link href="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.css" rel="stylesheet">



    <livewire:scripts />
</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')


        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>

            {{ $slot }}
        </main>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
            eval(livewire).set('datapo', $(this).val());
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
    </script>
    <script src="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.js"></script>
</body>

</html>