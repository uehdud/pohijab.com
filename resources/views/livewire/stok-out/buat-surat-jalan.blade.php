<div>
    <div class="card">
        <div class="card-header" style="box-shadow: none;">
            Surat Jalan Keluar
        </div>
        <div class="card-body">

            <!---TAMBAH PRODUK-->
            <div class="card-body">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif

                <div class="row m-2 float-right">
                    <x-jet-input wire:model="search" type="search" style="box-shadow: none;" placeholder="cari...kb/no po/model" />
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">NO PO</th>
                            <th class="text-center">KB</th>
                            <th class="text-center">Warna</th>
                            <th class="text-center">All Size</th>
                            <th class="text-center">S</th>
                            <th class="text-center">M</th>
                            <th class="text-center">L</th>
                            <th class="text-center">XL</th>
                            <th class="text-center">XXL</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (session()->has('pesan'))
                        <div class="alert alert-success">
                            {{ session('pesan') }}
                        </div>
                        @endif
                        @if($lproduk !== "Stok Belum Tersedia")
                        @foreach($listproduk as $item)
                        <tr>
                            <td class="text-center">{{$item->no_po}}</td>
                            <td class="text-center">{{$item->kode_barang}}</td>
                            <td class="text-center">{{$item->warna->nama_warna}}</td>
                            <td class="text-center">
                                @livewire('stok-out.data-allsize',['kb'=>$item->kode_barang, 'warna'=>$item->warna_id], key($item->id.$search))
                            </td>
                            <td class="text-center">
                                @livewire('stok-out.data-s',['kb'=>$item->kode_barang, 'warna'=>$item->warna_id], key($item->id.$search))
                            </td>
                            <td class="text-center">
                                @livewire('stok-out.data-m',['kb'=>$item->kode_barang, 'warna'=>$item->warna_id], key($item->id.$search))
                            </td>
                            <td class="text-center">
                                @livewire('stok-out.data-l',['kb'=>$item->kode_barang, 'warna'=>$item->warna_id], key($item->id.$search))
                            </td>
                            <td class="text-center">
                                @livewire('stok-out.data-xl',['kb'=>$item->kode_barang, 'warna'=>$item->warna_id], key($item->id.$search))
                            </td>
                            <td class="text-center">
                                @livewire('stok-out.data-x-x-l',['kb'=>$item->kode_barang, 'warna'=>$item->warna_id], key($item->id.$search))
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-success" wire:click="tambahItem({{ $item->id }}, 'update')">+</button>
                            </td>
                        </tr>


                        @endforeach

                    </tbody>
                </table>

            </div>
            <!---end TAMBAH PRODUK-->
        </div>
        @livewire('stok-out.cart-out')
        <div class="row mx-5 mb-5 mt-2">
            <div class="col-8"></div>
            <div class="col-4">
                <div class="row">
                    <x-jet-label>Gudang Tujuan <i class="text-danger">*</i></x-jet-label>
                    <x-jet-input id="gudang_tujuan" type="hidden" wire:model.lazy="gudang_tujuan" />
                    <div wire:ignore>
                        <select type="hidden" data-livewire="@this" class="js-select-gudang" wire:model="gudang_tujuan">
                            @foreach($listgudang as $gudang)
                            <option value="{{ $gudang->id }}">{{$gudang->nama_toko}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('gudang_tujuan') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="row mt-3">
                    <x-jet-label>Tanggal <i class="text-danger">*</i></x-jet-label>
                    <x-jet-input wire:model="tanggal_stok" type="date" />
                    @error('tanggal_stok') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="row my-3">
                    <x-jet-label>Keterangan <small><i>(opsional)</i></small></x-jet-label>
                    <x-jet-input wire:model="keterangan_stok" type="text" />
                </div>
                <x-jet-button wire:click="simpanSuratJalan">Simpan</x-jet-button>

            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="tambahCartOut" tabindex="-1" aria-labelledby="tambahCartOut" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahCartOut">Tambah </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">KB</th>
                                <th class="text-center">Warna</th>
                                <th class="text-center">All Size</th>
                                <th class="text-center">S</th>
                                <th class="text-center">M</th>
                                <th class="text-center">L</th>
                                <th class="text-center">XL</th>
                                <th class="text-center">XXL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">{{$kb}}</td>
                                <td class="text-center">{{$nama_warna}}</td>
                                <td class="text-center">
                                    {{ $cekstok }}
                                    <x-jet-input type="text" wire:model.defer="ukuran_allsize" style="max-width: 50px;" />
                                </td>
                                <td class="text-center">
                                    <x-jet-input type="text" wire:model.defer="ukuran_s" style="max-width: 50px;" />
                                </td>
                                <td class="text-center">
                                    <x-jet-input type="text" wire:model.defer="ukuran_m" style="max-width: 50px;" />
                                </td>
                                <td class="text-center">
                                    <x-jet-input type="text" wire:model.defer="ukuran_l" style="max-width: 50px;" />
                                </td>
                                <td class="text-center">
                                    <x-jet-input type="text" wire:model.defer="ukuran_xl" style="max-width: 50px;" />
                                </td>
                                <td class="text-center">
                                    <x-jet-input type="text" wire:model.defer="ukuran_xxl" style="max-width: 50px;" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                    <button type="button" class="btn btn-primary" wire:click="tambahCartOut">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    @else
    <tr>
        <td colspan="10" class="text-center">{{$lproduk}}</td>
    </tr>
    @endif
</div>