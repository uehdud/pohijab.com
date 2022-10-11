<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            Input Stok Pusat
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <x-jet-label>No PO</x-jet-label>
                    <x-jet-input wire:model="nomor_po" type="text" />
                    @error('nomor_po') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <x-jet-label>Qty Stok Masuk</x-jet-label>
                    <x-jet-input wire:model="jumlah_produksi" type="text" />
                    @error('jumlah_produksi') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mt-3">
                <x-jet-button wire:click="inputStokPusat">Simpan</x-jet-button>
            </div>

            <div class="row mt-3 ">

                @livewire('gudang.list-gudang-pusat')

            </div>

        </div>
    </div>

    <!-- Add Modal -->
    <div wire:ignore.self class="modal fade" id="pembagianStok" tabindex="-1" aria-labelledby="pembagianStok" aria-hidden="true">
        <div class="modal-dialog  d-block modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pembagianStok">Pembagian Stok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <x-jet-label>No PO</x-jet-label>
                                    <p>{{$no_po}}</p>
                                    <x-jet-input class="form-control" name="no_po" type="hidden" wire:model="no_po" />
                                </div>
                                <div class="col-md-3">
                                    <x-jet-label>Jumlah Produksi</x-jet-label>
                                    <p>{{$stok_awal}}</p>
                                    <x-jet-input class="form-control" type="hidden" name="jumlah_stok" wire:model="stok_awal" />
                                </div>
                                <div class="col-md-3">

                                    <x-jet-input class="form-control" name="no_po" type="hidden" wire:model="stok_akhir" />
                                </div>
                                <div class="col-md-3">
                                    <x-jet-label>Pembagian</x-jet-label>
                                    @if($stok_akhir<$pembagian) <p class="text-danger text-bold">{{ $pembagian ?? 0}}</p>
                                        @else
                                        <p>{{ $pembagian ?? 0}}</p>
                                        @endif
                                        <x-jet-input class="form-control" type="hidden" wire:model="pembagian" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mt-3 ">
                                        <div class="">
                                            <table class="table ">
                                                <thead>
                                                    <tr>
                                                        <th class="px-6 text-center">Toko</th>
                                                        <th class="px-6 text-center" style="width: 100px;">Qty</th>
                                                        <th style="width: 100px;"></th>
                                                        <th style="width: 100px;"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($tokos as $index => $toko)
                                                    <tr>
                                                        <td class="py-3 px-6 text-center">
                                                            <select name="tokos[{{$index}}][toko_id]" wire:model="tokos.{{$index}}.toko_id" id="" class="form-control">
                                                                <option value="" selected>Pilih Toko</option>
                                                                @foreach($listtoko as $item)
                                                                <option type="text" class="form-control" value="{{$item->id}}">{{$item->nama_toko}}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($valid === 1)
                                                            <span class="text-sm text-danger">Silahkan Pilih Toko</span>
                                                            @else
                                                            @endif
                                                        </td>
                                                        <td class="py-3 px-6 text-center">
                                                            <x-jet-input type="text" class="form-control" wire:model="tokos.{{$index}}.quantity" name="tokos[{{$index}}][quantity]" />
                                                            @error('tokos.{{$index}}.quantity') <span class="error">{{ $message }}</span> @enderror
                                                        </td>
                                                        <td class="py-3 px-6 text-center">
                                                            <x-jet-button wire:click.prevent="tambahToko">+</x-jet-button>
                                                        </td>
                                                        <td class="py-3 px-6 text-center">
                                                            <a href="#" wire:click.prevent="removeToko({{$index}})" style="text-decoration: none;" class="text-danger">
                                                                <div class="w-4 py-2 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                    </svg>
                                                                </div>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <a href="#" wire:click.prevent="cekstok">
                                                                <x-jet-button>Selesai</x-jet-button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 border-start">
                            <div class="row">
                                <div class="col">
                                    <div class="m-2" style="height: 300px; width:300px;">
                                        <h1 class="m-auto"> Image Sample</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="row my-3">
                                        <div class="col">
                                            <table class="table table-sm">
                                                <!-- <table data-toggle="table" data-search="true" data-show-columns="true" data-pagination="true" class="min-w-max w-full table-auto"> -->
                                                <thead>
                                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">

                                                        <th class=" px-6 text-center">Toko</th>
                                                        <th class=" px-6 text-center">Stok Pembagian</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-600 text-sm font-light">
                                                    @foreach($listpembagian as $index => $list)
                                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                                        <td class="py-3 px-6 text-center whitespace-nowrap">
                                                            {{ $list->namatoko->nama_toko}}
                                                        </td>
                                                        <td class="py-3 px-6 text-center">
                                                            {{ $list->jumlah_stok_pembagian}}
                                                        </td>
                                                        <td>
                                                            <a wire:click.prevent="delete({{ $list->id }})" class="text-danger">
                                                                <div class="w-4 py-2 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                    </svg>
                                                                </div>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>

                                                        <td class="py-3 px-6 text-center">Sisa</td>
                                                        <td class="py-3 px-6 text-center">{{$stok_akhir}}</td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div wire:loading wire:target="delete">
                                                Menghapus...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($buttonsimpan === 1 && $stok_akhir>=$pembagian)
                    <x-jet-button wire:click="simpanPembagian">Simpan</x-jet-button>
                    @else
                    <p class="text-danger text-sm">Pembagian stok tidak boleh lebih dari sisa stok tersedia</p>
                    @endif
                </div>

            </div>
        </div>
    </div>






</div>