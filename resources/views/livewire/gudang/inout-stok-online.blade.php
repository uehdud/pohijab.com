<div>
    <div class="card">
        <div class="card-header">
            Input Stok Online
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="mt-3">
                        <div class="row">
                            <div class="col">
                                <x-jet-label>Gudang Asal<i class="text-danger">*</i></x-jet-label>
                                <select wire:model="gudang_asal" name="" id="">
                                    <option selected>Pilih</option>
                                    @foreach($mstgudang as $gudang)
                                    <option value="{{$gudang->id}}">{{$gudang->nama_gudang}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <x-jet-label>Gudang Tujuan<i class="text-danger">*</i></x-jet-label>
                                <select wire:model="gudang_tujuan" name="" id="">
                                    <option selected>Pilih</option>
                                    @foreach($mstgudang as $gudang)
                                    <option value="{{$gudang->id}}">{{$gudang->nama_gudang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                @error('gudang_asal') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                @error('gudang_tujuan') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <x-jet-label>No Surat Jalan<i class="text-danger">*</i></x-jet-label>
                        <x-jet-input type="text" class="form-control" wire:model="no_surat_jalan" />
                        @error('no_surat_jalan') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-3">
                        <x-jet-label>Tanggal Surat Jalan<i class="text-danger">*</i></x-jet-label>
                        <x-jet-input type="date" class="form-control" wire:model="tanggal_surat_jalan" />
                        @error('tanggal_surat_jalan') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-3">
                        <x-jet-label>Keterangan</x-jet-label>
                        <x-jet-input type="text" class="form-control" wire:model="keterangan" />
                    </div>
                    <div class="mt-3">
                        <table class="table">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-center">Kode Barang</th>
                                    <th class="py-3 px-6 text-center">Qty</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suratjalan as $index => $sj)
                                <tr>
                                    <td class="py-3 px-6 text-center">
                                        <x-jet-input type="text" wire:model="suratjalan.{{$index}}.kode_barang" class="form-control" value="{{$sj['kode_barang']}}" />
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <x-jet-input type="number" wire:model="suratjalan.{{$index}}.quantity" class="form-control" value="{{$sj['quantity']}}" />
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <x-jet-button wire:click.prevent="tambahBarang">+</x-jet-button>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <a href="#" wire:click.prevent="removeBarang({{$index}})" style="text-decoration: none;" class="text-danger">
                                            hapus
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td class="py-3 px-6 text-center">Jumlah</td>
                                    <td class="py-3 px-6 text-center">
                                        {{ $jmlh }}
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <x-jet-button wire:click="selesai">Selesai</x-jet-button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        @if($btnsimpan === 1)
                        <x-jet-button wire:click="tambahStok">Simpan</x-jet-button>
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <table class="table">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-center">No Surat Jalan</th>
                                <th class="py-3 px-6 text-center">Jumlah Barang</th>
                                <th class="py-3 px-6 text-center">Keterangan</th>
                                <th class="py-3 px-6 text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sjalan as $item)
                            <tr>
                                <td class="py-3 px-6 text-center">
                                    {{ $item->nomor_surat_jalan }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ $item->jumlah_produk }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ $item->gudangTujuan->nama_gudang}}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <button wire:click="showSJmasuk({{$item->id}})" data-bs-toggle="modal" data-bs-target="#suratJalan" class="text-sm text-dark px-1" style="text-decoration: none;"><i class="fa-solid fa-eye"></i></button>
                                    <a href="#" class="text-sm text-dark px-1" style="text-decoration: none;"><i class="fa-solid fa-print"></i></a>
                                    <a href="#" class="text-sm text-dark px-1" style="text-decoration: none;"> <i class="fa-solid fa-pen"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="suratJalan" tabindex="-1" aria-labelledby="suratJalan" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="suratJalan">NO. {{$nsj}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="div">
                        <div class="row">
                            <div class="col">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Gudang Asal</th>
                                            <th>Gudang Tujuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p>{{ $tanggal_sj }}</p>
                                            </td>
                                            <td>
                                                <p>{{$ket}}</p>
                                            </td>
                                            <td>
                                                <p>{{$gd_asal}}</p>
                                            </td>
                                            <td>
                                                <p>{{$gd_tujuan}}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Qty</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i=1;
                                        @endphp
                                        @foreach($produkSj as $item )
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$item->kode_barang}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td><a wire:click="deleteProduk({{$item->id}})"><i class="fa-solid fa-trash-can"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div>