<div>
    <div class="card card-warning card-outline" style="box-shadow: none;">
        <div class="card-header">
            <div class="row">
                <div class="col-4">
                    List Produk Import
                </div>
                <div class="col-8 ">
                    <x-jet-button class="float-right" wire:click="clearData">clear data</x-jet-button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-hover  text-center table-sm text-sm">
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Produk</th>
                        <th>Total Qty</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listimportproduk as $produk)
                    <tr>

                        <td class="py-2">{{$produk->gudang_penerima}}</td>
                        <td class="py-2">{{$produk->barang}}</td>
                        <td class="py-2">{{$produk->qty}}</td>
                        <td>
                            <button wire:click="tambah({{$produk->id}})" class="btn btn-sm btn-success">+</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>