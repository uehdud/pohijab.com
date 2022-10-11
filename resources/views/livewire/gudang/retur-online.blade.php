<div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="kode barang" aria-label="kode barang" aria-describedby="button-addon2">
        <button class="btn btn-outline-dark" type="button" id="button-addon2">Cari</button>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th class="py-3 px-3 text-center">Kode Barang</th>
                <th class="py-3 px-3 text-center">Stok</th>
                <th class="py-3 px-3 text-center"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($stokonline as $item)
            <tr>
                <td class="py-3 px-3 text-center">{{$item->kode_barang}}</td>
                <td class="py-3 px-3 text-center">{{$item->jumlah_stok_online}}</td>
                <td class="py-3 px-3 text-center">
                    @if($tambahprdk === 1)
                    <button wire:click='addCart({{ $item->id }})' class="btn btn-sm btn-outline-dark" style="text-decoration: none;">+</i></button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>