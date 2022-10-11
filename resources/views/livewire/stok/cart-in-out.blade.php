<div>
    <!---LIST CART-->
    <div class="card mt-3" style="box-shadow: none;">
        <div class="card-body">
            <div class="row mx-1 my-0">
                <table class="table table-bordered mb-0">
                    <thead class="bg-gray-500 text-light">
                        <tr>
                            <th class="text-sm text-center border-1 py-2" style="width: 106px;">KB</th>
                            <th class="text-sm text-center border-1 py-2" style="width: 100px;">WARNA</th>
                            <th class="text-sm text-center border-1 py-2" style="width: 207px;">ART</th>
                            <th class="text-sm text-center border-1 py-2" style="width: 106px;">KGR</th>
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
            </div>
            @foreach($cartproduk as $index => $item)
            @livewire('stok.cart-table',['kb'=>$item->kode_barang, 'warna'=>$item->id_warna, key($item->id.$index)])

            @endforeach
        </div>
    </div>
    <!---end LIST CART-->
</div>