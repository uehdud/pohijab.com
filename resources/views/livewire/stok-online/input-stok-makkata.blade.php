<div>
    <div>
        <div class="card" style="box-shadow: none;">

            <!---TAMBAH PRODUK-->
            <div class="card-body">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif

                <div class="row m-2 float-right">
                    <x-jet-input wire:model="search" type="text" style="box-shadow: none;" placeholder="cari...kb/no po/model" />
                </div>
                <table class="table ">
                    <thead style="">
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
                        @foreach($listproduk as $item)
                        <tr>
                            <td class="text-center">{{$item->kode_barang}}</td>
                            <td class="text-center" >
                                <x-jet-input id="warna" type="hidden" wire:model.lazy="warna" style="max-width: 150px;" />
                                <div wire:ignore style="max-width: 150px;">
                                    <select type="hidden" data-livewire="@this" class="js-select" wire:model="warna" style="max-width: 150px;">
                                        <option value="" class="mb-2">pilih warna</option>
                                        @foreach($listwarna as $warna)
                                        <option value="{{ $warna->id }}">{{$warna->nama_warna}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td class="text-center">
                                <x-jet-input wire:model="ukuran_allsize" type="text" style="max-width: 50px;" />
                            </td>
                            <td class="text-center">
                                <x-jet-input wire:model="ukuran_s" type="text" style="max-width: 50px;" />
                            </td>
                            <td class="text-center">
                                <x-jet-input wire:model="ukuran_m" type="text" style="max-width: 50px;" />
                            </td>
                            <td class="text-center">
                                <x-jet-input wire:model="ukuran_l" type="text" style="max-width: 50px;" />
                            </td>
                            <td class="text-center">
                                <x-jet-input wire:model="ukuran_xl" type="text" style="max-width: 50px;" />
                            </td>
                            <td class="text-center">
                                <x-jet-input wire:model="ukuran_xxl" type="text" style="max-width: 50px;" />
                            </td>


                            <td class="text-center">
                                <button class="btn btn-sm btn-success" wire:click="tambahStok({{$item->kode_barang}})">+</button>
                            </td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td class="text-center"> @error('warna') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                            </td>
                            <td> </td>

                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
            <!---end TAMBAH PRODUK-->



        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="editStokOnline" tabindex="-1" aria-labelledby="editStokOnline" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStokOnline">Input Data Stok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col mt-2">
                            <x-jet-label>Lokasi</x-jet-label>
                            <x-jet-input wire:model.defer="lokasi" type="text" style="max-width: 75px; max-height: 35px;" />
                        </div>
                        <div class="col mt-2">
                            <x-jet-label>Qty</x-jet-label>
                            <x-jet-input wire:model.defer="edit_allsize" type="text" style="max-width: 75px; max-height: 35px;" />
                        </div>
                        <div class="col mt-2">
                            <x-jet-label>LD</x-jet-label>
                            <x-jet-input wire:model.defer="ukuran_ld" type="text" style="max-width: 75px; max-height: 35px;" />
                        </div>
                        <div class="col mt-2">
                            <x-jet-label>PB</x-jet-label>
                            <x-jet-input wire:model.defer="ukuran_pb" type="text" style="max-width: 75px; max-height: 35px;" />
                        </div>
                        <div class="col mt-2">
                            <x-jet-label>LP</x-jet-label>
                            <x-jet-input wire:model.defer="ukuran_lp" type="text" style="max-width: 75px; max-height: 35px;" />
                        </div>
                        <div class="col mt-2">
                            <x-jet-label>LPH</x-jet-label>
                            <x-jet-input wire:model.defer="ukuran_lph" type="text" style="max-width: 75px; max-height: 35px;" />
                        </div>
                        <div class="col mt-2">
                            <x-jet-label>PC/PCR</x-jet-label>
                            <x-jet-input wire:model.defer="ukuran_pc" type="text" style="max-width: 75px; max-height: 35px;" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                    <button type="button" class="btn btn-primary" wire:click="simpaneditStok">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>