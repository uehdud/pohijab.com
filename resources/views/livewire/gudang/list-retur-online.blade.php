<div>
    <h5>List Surat Jalan Keluar</h5>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>No Nota</th>
                <th>Tanggal</th>
                <th>Jumlah Produk</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($suratjalan as $item)
            <tr>
                <td>{{$item->nomor_surat_jalan}}</td>
                <td>{{$item->tanggal_surat_jalan}}</td>
                <td>{{$item->jumlah_produk}}</td>
                <td>
                    <a href="#" class="text-sm text-dark px-1" style="text-decoration: none;"><i class="fa-solid fa-eye"></i></a>
                    <a href="#" class="text-sm text-dark px-1" style="text-decoration: none;"><i class="fa-solid fa-print"></i></a>
                    <a href="#" class="text-sm text-dark px-1" style="text-decoration: none;"> <i class="fa-solid fa-pen"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>