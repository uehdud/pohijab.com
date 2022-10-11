<div>
    <!---LIST CART-->
    <div class="card mt-3" style="box-shadow: none;">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <x-jet-input wire:model="search" type="text" style="box-shadow: none;" placeholder="cari kb" />
                </div>
                <div class="col m-2"><b>List Stok Makkata</b> </div>
                <div class="col m-2"> Total Stok: {{$jumlahstok}}</div>
            </div>

        </div>
        <div class="card-body">
            <div class="row mx-1 my-0">
                <table class="table table-bordered mb-0">
                    <thead class="bg-gray-500 text-light">
                        <tr>
                            <th class="text-sm text-center border-1 py-2" style="width: 100px;">Lokasi</th>
                            <th class="text-sm text-center border-1 py-2" style="width: 100px;">KB</th>
                            <th class="text-sm text-center border-1 py-2" style="width: 100px;">WARNA</th>
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
            </div>
            @foreach($liststokmakkata as $index => $item)
            @livewire('stok-online.tabel-list-stok',['kb'=>$item->kode_barang, 'warna'=>$item->warna_id, key($item->id.$index)])

            @endforeach
        </div>
    </div>
    <!---end LIST CART-->
    {{ $liststokmakkata->links() }}
</div>