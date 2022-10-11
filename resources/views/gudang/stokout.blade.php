<x-planet-layout>

    <div class="row">
        <div class="col">
            @livewire('suratjalan.sj-pusat')
        </div>
        <!-- <div class="col-md-4">
            <div class="card card-warning " style="box-shadow: none;">
                <div class="card-header">
                    Import Data
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            //<form action="{{route('admingudang.stokout.store')}}" enctype="multipart/form-data" method="POST">

                                csrf
                                <input type="file" name="import_file">
                                <br>
                                <x-jet-button class="mt-3" type="submit">Import</x-jet-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                livewire('suratjalan.list-import-produk')
            </div>
        </div> -->
    </div>
    <div class="mt-3">
        @livewire('suratjalan.list-sj-keluar-pusat')
    </div>



    <!--  livewire('stok-out.buat-surat-jalan')
livewire('suratjalan.list-surat-jalan') -->
</x-planet-layout>