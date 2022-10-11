<div>
    <div class="card">
        <div class="card-header">Pembagian Stok</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Pilih PO</option>
                        @foreach($listpo as $item)
                        <option value="{{$item->id}}">{{$item->no_po}} - Stok awal: {{$item->stok_po}}pcs</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-3 ">
                <div class="">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th class="px-6 text-center" style="width: 250px;">Toko</th>
                                <th class="px-6 text-center">Qty</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tokos as $index => $toko)
                            <tr>
                                <td class="py-3 px-6 text-center">
                                    <select name="$listtoko[{{$index}}][toko_id]" id="" class="form-control">
                                        <option selected>Pilih Toko</option>
                                        @foreach($listtoko as $item)
                                        <option type="text" class="form-control" value="{{$item->id}}">{{$item->nama_toko}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <x-jet-input type="number" class="form-control" name="$listtoko[{{$index}}][qty]" value="{{$toko['qty']}}" />
                                </td>
                                <td class="py-3 px-6 text-center">
                                <x-jet-button wire:click.prevent="tambahToko">+</x-jet-button>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <a href="#" wire:click.prevent="removeToko({{$index}})" style="text-decoration: none;" class="text-danger">
                                        hapus
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class=" row m-3 justify-content-end">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <x-jet-button>Simpan</x-jet-button>
            </div>
        </div>
    </div>
</div>