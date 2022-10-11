<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <!-- Button trigger modal -->
    <x-jet-button type="button" data-bs-toggle="modal" data-bs-target="#tambahProduk">
        Tambah Produk
    </x-jet-button>

    <!-- Add Modal -->
    <div wire:ignore.self class="modal fade" id="tambahProduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  d-block modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="m-3">
                                <x-jet-label>No PO</x-jet-label>
                                <x-jet-input style="text-transform: uppercase" wire:model="nomor_po" type="text" class="form-control" />
                                @error('nomor_po') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="m-3">
                                <div class="row">
                                    <div class="col">
                                        <x-jet-label>Merk</x-jet-label>
                                        <x-jet-input style="text-transform: uppercase" wire:model="merk" type="text" class="form-control" />
                                        @error('merk') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col">
                                        <x-jet-label>Kode Model</x-jet-label>
                                        <x-jet-input style="text-transform: uppercase" wire:model="kode_model" type="text" class="form-control" />
                                        @error('kode_model') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="m-3">
                                <div class="row">
                                    <div class="col">
                                        <x-jet-label>Kode Barang</x-jet-label>
                                        <x-jet-input style="text-transform: uppercase" wire:model="kode_barang" type="text" class="form-control" />
                                        @error('kode_barang') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col">
                                        <x-jet-label>Qty Seri</x-jet-label>
                                        <x-jet-input wire:model="qty_seri" type="text" class="form-control" />
                                        @error('qty_seri') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="m-3">
                                <x-jet-label>Bahan</x-jet-label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <x-jet-input style="text-transform: uppercase" wire:model="kode_bahan" type="text" class="form-control" placeholder="kode bahan" />
                                        @error('kode_bahan') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-sm-8">
                                        <x-jet-input wire:model="nama_bahan" type="text" class="form-control" placeholder="nama bahan" />
                                        @error('nama_bahan') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="m-3">
                                <x-jet-label>Harga</x-jet-label>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">X</span>
                                            <x-jet-input style="text-transform: uppercase" wire:model="harga_ta" type="text" class="form-control" />
                                            @error('harga_ta') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">JX</span>
                                            <x-jet-input style="text-transform: uppercase" wire:model="harga_planet" type="text" class="form-control" />
                                            @error('harga_planet') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="m-3">
                                <x-jet-label>Keterangan <i style="font-size: 12px;">(boleh dikosongkan)</i></x-jet-label>
                                <x-jet-input style="text-transform: uppercase" wire:model="keterangan_po" type="text" class="form-control" />
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