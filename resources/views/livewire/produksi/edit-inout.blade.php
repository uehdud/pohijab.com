<div>
    <div wire:ignore.self class="modal fade" id="editInout" tabindex="-1" aria-labelledby="editInout" aria-hidden="true">
        <div class="modal-dialog  d-block modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editInout">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="m-3">
                                <x-jet-label>Kode Barang</x-jet-label>
                                <x-jet-input wire:model="kode_barang" type="text" class="form-control" />
                                @error('kode_barang') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="m-3">
                                <x-jet-label>Qty Terima</x-jet-label>
                                <x-jet-input wire:model="qty_terima" type="text" class="form-control" />
                                @error('qty_terima') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="m-3">
                                <x-jet-label>No SJ <i style="font-size: 12px;">(boleh dikosongkan)</i></x-jet-label>
                                <x-jet-input wire:model="no_surat_jalan" type="text" class="form-control" />

                            </div>

                            <div class="m-3">
                                <x-jet-label>Keterangan <i style="font-size: 12px;">(boleh dikosongkan)</i></x-jet-label>
                                <x-jet-input wire:model="keterangan" type="text" class="form-control" />

                            </div>

                        </div>
                        <div class="col-sm-5">
                            <div class="m-3">
                                <x-jet-label>Upload Foto Combo</x-jet-label>
                                <x-jet-input wire:model="image_name" type="file" />
                                <x-jet-button wire:click.prevent="simpanGambar">simpan gambar</x-jet-button>
                            </div>

                        </div>
                    </div>

                    <br />
                    <x-jet-button wire:click.prevent="saveproduk">Simpan</x-jet-button>
                </div>

            </div>
        </div>
    </div>

</div>