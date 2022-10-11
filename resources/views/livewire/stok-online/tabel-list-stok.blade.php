<div>
    <div class="row mx-1 my-0">
        <table class="table table-bordered mb-0">
            <tbody>
                <tr>
                    <td class=" text-sm text-center py-2" style="width: 100px;">{{$datakb->lokasi}}</td>
                    <td class=" text-sm text-center py-2" style="width: 100px;">{{$datakb->kode_barang}}</td>
                    <td class=" text-sm text-center py-2" style="width: 100px;">{{$datakb->warna->nama_warna}}</td>
                    @if($edit === 0)
                    <td class=" text-center text-sm text-secondary py-2" style="width: 100px;">{{$data_allsize->jumlah_stok_online ?? ''}}</td>
                    <td class=" text-center text-sm text-secondary py-2" style="width: 50px;">{{$data_s->jumlah_stok_online ?? ''}}</td>
                    <td class=" text-center text-sm text-secondary py-2" style="width: 50px;">{{$data_m->jumlah_stok_online ?? ''}}</td>
                    <td class=" text-center text-sm text-secondary py-2" style="width: 50px;">{{$data_l->jumlah_stok_online ?? ''}}</td>
                    <td class=" text-center text-sm text-secondary py-2" style="width: 50px;">{{$data_xl->jumlah_stok_online ?? ''}}</td>
                    <td class=" text-center text-sm text-secondary py-2" style="width: 75px;">{{$data_xxl->jumlah_stok_online ?? ''}}</td>
                    <td class=" text-center text-sm py-2" style="width: 100px;"><b>{{$jumlah}}</b></td>
                    <td class=" text-center text-sm py-2" style="width: 150px;">
                        <div class="row p-0 m-0">
                            <div class="col p-0">
                                <p class="text-success" type="button" wire:click="editStokCart"><small><i class="fa-solid fa-pen-to-square"></i>edit</small></p>
                            </div>
                        </div>
                    </td>
                    @else
                    <td class=" text-center text-sm py-2" style="width: 100px;">
                        <x-jet-label>allsize</x-jet-label>
                        <x-jet-input style="max-width: 50px;" type="number" wire:model.defer="edit_allsize" />
                    </td>
                    <td class=" text-center text-sm py-2" style="width: 100px;">
                        <x-jet-label>S</x-jet-label>
                        <x-jet-input style="max-width: 50px;" type="number" wire:model.defer="edit_s" />
                    </td>
                    <td class=" text-center text-sm py-2" style="width: 100px;">
                        <x-jet-label>M</x-jet-label>
                        <x-jet-input style="max-width: 50px;" type="number" wire:model.defer="edit_m" />
                    </td>
                    <td class=" text-center text-sm py-2" style="width: 100px;">
                        <x-jet-label>L</x-jet-label>
                        <x-jet-input style="max-width: 50px;" type="number" wire:model.defer="edit_l" />
                    </td>
                    <td class=" text-center text-sm py-2" style="width: 100px;">
                        <x-jet-label>XL</x-jet-label>
                        <x-jet-input style="max-width: 50px;" type="text" wire:model.defer="edit_xl" />
                    </td>
                    <td class=" text-center text-sm py-2" style="width: 100px;">
                        <x-jet-label>XXL</x-jet-label>
                        <x-jet-input style="max-width: 50px;" type="number" wire:model.defer="edit_xxl" />
                    </td>
                    <td class=" text-center text-sm py-2" style="width: 150px;">
                        <div class="row p-0 m-0">
                            <div class="col p-0">
                                <p class="text-success" type="button" wire:click="simpanEdit"><small><i class="fa-solid fa-pen-to-square"></i>simpan</small></p>
                            </div>
                        </div>
                    </td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>