<div>
    @livewire('gudang.retur-stok')

    <div class="mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th class="py-3 px-3 text-center">Kode Barang</th>
                    <th class="py-3 px-3 text-center">Qty</th>
                    <th class="py-3 px-3 text-center"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($produk_inout as $item)
                <tr>
                    <td class="py-3 px-3 text-center">{{ $item->kode_barang }}</td>
                    <td class="py-3 px-3 text-center">{{ $item->quantity }}</td>
                    <td class="py-3 px-3 text-center"><a href="#" class="text-sm text-danger">hapus</a></td>
                </tr>
                @endforeach
                <tr>
                    <td class="py-3 px-3 text-center">Total</td>
                    <td class="py-3 px-3 text-center"></td>
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row mt-3">
        <div class="col"></div>
        <div class="col">
            <x-jet-button>Proses</x-jet-button>
        </div>
    </div>
</div>