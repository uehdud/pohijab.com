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

    <!-- Modal -->
    <div class="modal fade" id="editStokCart" tabindex="-1" aria-labelledby="editStokCart" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStokCart">Edit {{$datakb->kode_barang}} - {{$datakb->warna->nama_warna}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mt-1 text-center">
                            <x-jet-label>All Size</x-jet-label>
                            <x-jet-input style="max-width: 75px;" type="text" wire:model.defer="edit_allsize" />
                        </div>
                        <div class="col mt-1 text-center">
                            <x-jet-label>S</x-jet-label>
                            <x-jet-input style="max-width: 75px;" type=" text" wire:model.defer="edit_s" />
                        </div>
                        <div class="col mt-1 text-center">
                            <x-jet-label>M</x-jet-label>
                            <x-jet-input style="max-width: 75px;" type=" text" wire:model.defer="edit_m" />
                        </div>
                        <div class="col mt-1 text-center">
                            <x-jet-label>L</x-jet-label>
                            <x-jet-input style="max-width: 75px;" type=" text" wire:model.defer="edit_l" />
                        </div>
                        <div class="col mt-1 text-center">
                            <x-jet-label>XL</x-jet-label>
                            <x-jet-input style="max-width: 75px;" type=" text" wire:model.defer="edit_xl" />
                        </div>
                        <div class="col mt-1 text-center">
                            <x-jet-label>XXL</x-jet-label>
                            <x-jet-input style="max-width: 75px;" type="text" wire:model.defer="edit_xxl" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" wire:click="simpanEdit">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>