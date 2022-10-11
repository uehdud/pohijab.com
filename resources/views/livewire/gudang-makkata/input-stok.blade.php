<div>
    <div class="card" style="box-shadow: none;">


        <div class="card-header text-center">
            <b>Nota Stok Masuk Gudang Pusat (GSP)</b>
        </div>

        <div class="card-body">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif


            <div class="row mt-3">
                @livewire('gudang-makkata.list-produk')
            </div>
            <div class="row mx-1 my-0">
                <table class="table table-bordered mb-0">
                    <thead class="bg-gray-500 text-light">
                        <tr>
                            <th class="text-sm text-center border-1 py-2" style="width: 100px;">KB</th>
                            <th class="text-sm text-center border-1 py-2" style="width: 100px;">WARNA</th>
                            <th class="text-sm text-center border-1 py-2" style="width: 200px;">ART</th>
                            <th class="text-sm text-center border-1 py-2" style="width: 100px;">KGR</th>
                            <th class="text-sm text-center border-1 py-2" style="width: 100px;">MODAL</th>
                            <th class="text-sm text-center border-1 py-2" style="width: 100px;">ALL SIZE</th>
                            <th class="text-sm text-center border-1 py-2" style="width: 50px;">S</th>
                            <th class="text-sm text-center border-1 py-2" style="width: 50px;">M</th>
                            <th class="text-sm text-center border-1 py-2" style="width: 50px;">L</th>
                            <th class="text-sm text-center border-1 py-2" style="width: 50px;">XL</th>
                            <th class="text-sm text-center border-1 py-2" style="width: 75px;">XXL</th>
                            <th class="text-sm text-center border-1 py-2" style="width: 100px;">Jumlah</th>
                            <th class="text-sm text-center border-1 py-2" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                </table>
                <!-- <div class="row">
                    <div class=" text-center border-1 py-2" style="width: 100px;">KB</div>
                    <div class=" text-center border-1 py-2" style="width: 100px;">KON</div>
                    <div class=" text-center border-1 py-2" style="width: 200px;">ART</div>
                    <div class=" text-center border-1 py-2" style="width: 100px;">KGR</div>
                    <div class=" text-center border-1 py-2" style="width: 100px;">MODAL</div>
                    <div class=" text-center border-1 py-2" style="width: 100px;">ALL SIZE</div>
                    <div class="text-center border-1 py-2" style="width: 50px;">S</div>
                    <div class=" text-center border-1 py-2" style="width: 50px;">M</div>
                    <div class=" text-center border-1 py-2" style="width: 50px;">L</div>
                    <div class="text-center border-1 py-2" style="width: 50px;">XL</div>
                    <div class=" text-center border-1 py-2" style="width: 75px;">XXL</div>
                </div> -->



            </div>
            @foreach($cartproduk as $index => $item)
            @livewire('tabel.cart-masuk-makkata',['kb'=>$item->kode_barang, 'warna'=>$item->id_warna])
            @endforeach



        </div>
        @livewire('tanggal-nota')
        

    </div>

    <div class="card">
        <div class="card-header">
            List Surat jalan
        </div>
        <div class="card-body mb-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Sj</th>
                        <th>Tanggal</th>
                        <th>Gudang Tujuan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i=1;
                    @endphp

                    <tr>
                        <td>{{ $i++ }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <button wire:click="" data-bs-toggle="modal" data-bs-target="#suratJalan" class="text-sm text-dark px-1" style="text-decoration: none;"><i class="fa-solid fa-eye"></i></button>
                            <a href="#" class="text-sm text-dark px-1" style="text-decoration: none;"><i class="fa-solid fa-print"></i></a>
                            <a href="#" class="text-sm text-dark px-1" style="text-decoration: none;"> <i class="fa-solid fa-pen"></i></a>
                            <button class="text-sm text-dark px-1" style="text-decoration: none;" wire:click=""> <i class="fa-solid fa-trash-can"></i></button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>