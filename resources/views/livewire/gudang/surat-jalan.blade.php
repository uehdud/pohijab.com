<div>
    <div class="card">
        <div class="card-header text-center">
            Surat Jalan Gudang Pusat (GSP)
        </div>
        <div class="card-body">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <x-jet-label>Gudang Tujuan<i class="text-danger">*</i></x-jet-label>
                            <select wire:model="gudang_tujuan" name="" id="">
                                <option selected>Pilih</option>
                                @foreach($mstgudang as $item)
                                <option value="{{$item->id}}">{{$item->nama_toko}}</option>
                                @endforeach
                            </select>
                            <br>
                            @error('gudang_tujuan') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col">
                            <x-jet-label class="float-center">No Nota </x-jet-label>
                            <input value="00001" disabled />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mt-3">
                                <x-jet-label>No Surat Jalan<i class="text-danger">*</i></x-jet-label>
                                <x-jet-input type="text" class="form-control" wire:model="no_sj" />
                                @error('no_sj') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mt-3">
                                <x-jet-label>Tanggal Surat Jalan<i class="text-danger">*</i></x-jet-label>
                                <x-jet-input type="date" class="form-control" wire:model="tanggal_sj" />
                                @error('tanggal_sj') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <x-jet-label>Keterangan <small><i>opsional</i></small></x-jet-label>
                        <x-jet-input type="text" class="form-control" wire:model="keterangan" />
                    </div>
                </div>
                <div class="col">
                    @livewire('gudang.list-stok-pusat')
                </div>
            </div>

            <div class="row m-5">
                @php
                $i=1;
                @endphp
                <table class="table table-bordered"">
                    <thead >
                    <th class=" text-center">No</th>
                    <th class="text-center">KB</th>
                    <th class="text-center">KON</th>
                    <th class="text-center">ART</th>
                    <th class="text-center">KGR</th>
                    <th class="text-center">MODAL</th>
                    <th class="text-center">QTY</th>
                    <th class="text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach($cartproduk as $index => $item)
                        <tr data-title="bootstrap table">
                            <td class="text-center">{{$i++}}</td>
                            <td class="text-center">{{$item->kode_barang}}</td>
                            <td class="text-center">{{$item->kode_supp}}</td>
                            <td class="text-center">
                                {{$item->id_kategori}}.{{$item->kode_model}}.{{$item->kode_bahan}}.{{$item->kode_merk}}
                            </td>
                            <td class="text-center">{{$item->kode_kategori}}</td>
                            <td class="text-center">{{$item->kode_harga_modal}}</td>
                            <td class="text-center">{{$item->quantity}}</td>
                            <td class="text-center">
                                <button style="text-decoration: none;" class="text-danger" wire:click="hapus({{$item->id}})"><small>hapus</small></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col">
                    <x-jet-button wire:click="simpan" class="float-right mr-5">Simpan</x-jet-button>
                </div>
            </div>

        </div>


    </div>

    <div class="card">
        <div class="card-header">
            List Surat jalan
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Sj</th>
                        <th>Tanggal</th>
                        <th>Gudang Tujuan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i=1;
                    @endphp
                    @foreach($listsj as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{$item->nomor_surat_jalan}}</td>
                        <td>{{$item->tanggal_surat_jalan}}</td>
                        <td>{{$item->toko->nama_toko}}</td>
                        <td>
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