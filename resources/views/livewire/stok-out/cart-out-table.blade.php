<div>
<div class="row mx-1 my-0">
        <table class="table table-bordered mb-0">
            <tbody>
                <tr>
                    <td class=" text-sm text-center py-2" style="width: 100px;">{{$datakb->kode_barang}}</td>
                    <td class=" text-sm text-center py-2" style="width: 100px;">{{$datakb->warna->nama_warna}}</td>
                    @if($edit === 0)
                    <td class=" text-sm text-center py-2" style="width: 200px;">
                        {{$datakb->produk->kode_supp}}.
                        {{$datakb->produk->id_kategori}}.
                        {{$datakb->produk->kode_model}}.
                        {{$datakb->produk->kode_bahan}}.
                        {{$datakb->produk->kode_merk}}
                    </td>
                    <td class=" text-center text-sm py-2" style="width: 100px;">{{$datakb->produkkategori->kode_kategori}}</td>
                    <td class=" text-center text-sm py-2" style="width: 100px;">{{$datakb->produk->kode_harga_modal}}</td>
                    <td class=" text-center text-sm text-secondary py-2" style="width: 100px;">{{$data_allsize->quantity ?? ''}}</td>
                    <td class=" text-center text-sm text-secondary py-2" style="width: 50px;">{{$data_s->quantity ?? ''}}</td>
                    <td class=" text-center text-sm text-secondary py-2" style="width: 50px;">{{$data_m->quantity ?? ''}}</td>
                    <td class=" text-center text-sm text-secondary py-2" style="width: 50px;">{{$data_l->quantity ?? ''}}</td>
                    <td class=" text-center text-sm text-secondary py-2" style="width: 50px;">{{$data_xl->quantity ?? ''}}</td>
                    <td class=" text-center text-sm text-secondary py-2" style="width: 75px;">{{$data_xxl->quantity ?? ''}}</td>
                    <td class=" text-center text-sm py-2" style="width: 100px;"><b>{{$jumlah}}</b></td>
                    <td class=" text-center text-sm py-2" style="width: 150px;">
                        <div class="row p-0 m-0">
                            <div class="col p-0">
                                <p class="text-success" type="button" wire:click="editStokCart"><small><i class="fa-solid fa-pen-to-square"></i>edit</small></p>
                            </div>
                            <div class="col p-0">
                                <p class="text-danger" type="button"><small wire:click="hapus"><i class="fa-solid fa-trash-can"></i>hapus</small></p>
                            </div>
                        </div>
                    </td>
                    @else
                    <td class=" text-center text-sm py-2" style="width: 100px;">
                        <x-jet-label>allsize</x-jet-label>
                        <x-jet-input style="max-width: 50px;" type="text" wire:model.defer="edit_allsize" />
                    </td>
                    <td class=" text-center text-sm py-2" style="width: 100px;">
                        <x-jet-label>S</x-jet-label>
                        <x-jet-input style="max-width: 50px;" type="text" wire:model.defer="edit_s" />
                    </td>
                    <td class=" text-center text-sm py-2" style="width: 100px;">
                        <x-jet-label>M</x-jet-label>
                        <x-jet-input style="max-width: 50px;" type="text" wire:model.defer="edit_m" />
                    </td>
                    <td class=" text-center text-sm py-2" style="width: 100px;">
                        <x-jet-label>L</x-jet-label>
                        <x-jet-input style="max-width: 50px;" type="text" wire:model.defer="edit_l" />
                    </td>
                    <td class=" text-center text-sm py-2" style="width: 100px;">
                        <x-jet-label>XL</x-jet-label>
                        <x-jet-input style="max-width: 50px;" type="text" wire:model.defer="edit_xl" />
                    </td>
                    <td class=" text-center text-sm py-2" style="width: 100px;">
                        <x-jet-label>XXL</x-jet-label>
                        <x-jet-input style="max-width: 50px;" type="text" wire:model.defer="edit_xxl" />
                    </td>
                    <td class=" text-center text-sm py-2" style="width: 150px;">
                        <div class="row p-0 m-0">
                            <div class="col p-0">
                                <p class="text-success" type="button" wire:click="simpanEdit"><small><i class="fa-solid fa-pen-to-square"></i>simpan</small></p>
                            </div>
                            <div class="col p-0">
                                <p class="text-danger" type="button"><small wire:click="hapus"><i class="fa-solid fa-trash-can"></i>hapus</small></p>
                            </div>
                        </div>
                    </td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>
