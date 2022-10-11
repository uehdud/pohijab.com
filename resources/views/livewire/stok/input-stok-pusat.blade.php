<div>
    



    <div class="card mt-3" style="box-shadow: none;">
        <div class="card-header">
            Input Stok Pusat
        </div>

        <div class="card-body">

            @livewire('stok.pilih-produk')
            <!--    livewire('stok.cart-in-out') -->
        </div>

        <div class="row mx-5 mb-5 mt-2">
            <div class="col-8 ">
                <div class="row">
                    <div class="col">
                        <div class="mt-3">
                            <x-jet-label>Kode Barang</x-jet-label>
                            <x-jet-input type="text" />
                        </div>
                        <div class="mt-3">
                            <x-jet-label>Artikel</x-jet-label>
                            <x-jet-input type="text" />
                        </div>
                        <div class="mt-3">
                            <x-jet-label>Kategori</x-jet-label>
                            <x-jet-input type="text" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="mt-3">
                            <x-jet-label>Harga Modal</x-jet-label>
                            <x-jet-input type="text" />
                        </div>
                        <div class="mt-3">
                            <x-jet-label>Harga Grosir</x-jet-label>
                            <x-jet-input type="text" />
                        </div>
                        <div class="mt-3">
                            <x-jet-label>Harga Jual</x-jet-label>
                            <x-jet-input type="text" />
                        </div>
                    </div>
                </div>
                <div class="row pr-5">
                    <div class="mt-3">
                        <x-jet-label>Jumlah Stok Masuk</x-jet-label>
                        <table class="table table-bordered mb-0">
                            <thead class="bg-gray-500 text-light">
                                <tr>
                                    <th class="text-sm text-center border-1 py-2" style="width: 100px;">Warna</th>
                                    <th class="text-sm text-center border-1 py-2" style="width: 100px;">ALL SIZE</th>
                                    <th class="text-sm text-center border-1 py-2" style="width: 50px;">S</th>
                                    <th class="text-sm text-center border-1 py-2" style="width: 50px;">M</th>
                                    <th class="text-sm text-center border-1 py-2" style="width: 50px;">L</th>
                                    <th class="text-sm text-center border-1 py-2" style="width: 50px;">XL</th>
                                    <th class="text-sm text-center border-1 py-2" style="width: 75px;">XXL</th>
                                    <th class="text-sm text-center border-1 py-2" style="width: 100px;">Jumlah</th>
                                    <th class="text-sm text-center border-1 py-2" style="width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-4">
                <div class="row my-3">
                    <x-jet-label>Supplier</x-jet-label>
                    <x-jet-input wire:model="tanggal_stok" type="text" />
                </div>
                <div class="row my-3">
                    <x-jet-label>Jumlah Produksi</x-jet-label>
                    <x-jet-input wire:model="tanggal_stok" type="text" />
                </div>
                <div class="row my-3">
                    <x-jet-label>Jumlah yang belum setor</x-jet-label>
                    <x-jet-input wire:model="tanggal_stok" type="text" />
                </div>
                <div class="row">
                    <div class="form-check">
                        <input wire.model="ceksuratjalan" class="form-check-input" type="checkbox" value="9" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Surat Jalan
                        </label>
                    </div>
                </div>
                <div class="row my-3">
                    <x-jet-label>No Surat Jalan</x-jet-label>
                    <x-jet-input wire:model="tanggal_stok" type="text" />
                </div>
                <div class="row my-3">
                    <x-jet-label>Tanggal <i class="text-danger">*</i></x-jet-label>
                    <x-jet-input wire:model="tanggal_stok" type="date" />
                    @error('tanggal_stok') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="row my-3">
                    <x-jet-label>Keterangan <small><i>(opsional)</i></small></x-jet-label>
                    <x-jet-input wire:model="keterangan_stok" type="text" />
                </div>
                <x-jet-button wire:click="simpanStok">Simpan</x-jet-button>
            </div>
        </div>
    </div>

</div>