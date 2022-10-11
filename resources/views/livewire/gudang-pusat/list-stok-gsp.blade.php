<div>
    <div class="card card-secondary card-outline" style="box-shadow: none;">
        <div class="card-header">List Stok Gudang Pusat (GSP)</div>
        <div class="card-body">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>ART</th>
                        <th>Modal</th>
                        <th>Stok</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i=1;
                    @endphp
                    @foreach($datastok as $stok)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$stok->kode_barang}}</td>
                        <td>{{$stok->detailProduk->kode_supp}}.{{$stok->detailProduk->id_kategori}}.{{$stok->detailProduk->kode_model}}.{{$stok->detailProduk->kode_bahan}}.{{$stok->detailProduk->kode_merk}}</td>
                        <td>{{$stok->detailProduk->kode_harga_modal}}</td>
                        <td>{{$stok->jumlahstok}}</td>
                        <td>
                            <x-jet-button>detail</x-jet-button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $datastok->links() }}
        </div>
    </div>
</div>