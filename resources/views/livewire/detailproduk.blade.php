<div>

    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <!-- Start Table -->
    <div class="card mt-3">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-4">
                    <input wire:model="search" type="search" placeholder="Cari KB/Model..." class="block w-full pl-10 pr-3 py-2 border border-gray-300
            rounded-md leading-5 bg-white
            placeholder-gray-500
            focus:outline-none
            focus:placeholder-gray-400
            focus:border-blue-300
            focus:shadow-outline-blue
            sm:text-sm transition duration-150 ease-in-out">
                </div>
            </div>
        </div>
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">PO Planet</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">PO Makkata & Clanela</a>
                </li>

            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                    <div class="col-md-12">
                        <div class="mt-3">
                            <table class="table">
                                <thead style="font-size: 14px;">
                                    <th>No</th>
                                    <th>No PO</th>
                                    <th>Merk</th>
                                    <th>Status</th>
                                    <th>Gudang</th>
                                    <th>KB</th>
                                    <th>Model</th>
                                    <th>Bahan</th>
                                    <th>Harga Planet</th>
                                    <th>Harga TA</th>
                                    <th>Qty Seri</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($produkProduksi as $index => $item)
                                    <tr data-title="bootstrap table" data-object='{"key": "value"}'>
                                        <td style="font-size: 12px;">{{$no++}}</td>
                                        <td style="font-size: 12px;">{{$item->nomor_po}}</td>
                                        <td style="font-size: 12px;">{{$item->merk}}</td>
                                        <td style="font-size: 12px;">
                                            {{$item->nama_status}}
                                        </td>
                                        <td style="font-size: 12px;">
                                            {{$item->nama_gudang}}
                                        </td>
                                        <td style="font-size: 12px;">{{$item->kode_barang}}</td>
                                        <td style="font-size: 12px;">{{$item->kode_model}}</td>
                                        <td style="font-size: 12px;">{{$item->kode_bahan}}-{{$item->nama_bahan}}</td>
                                        <td style="font-size: 12px;">{{$item->harga_planet}}</td>
                                        <td style="font-size: 12px;">{{$item->harga_ta}}</td>
                                        <td style="font-size: 12px;">{{$item->qty_seri}}</td>
                                        <td style="font-size: 12px;">{{$item->keterangan_po}}</td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center">
                                                <a href="" wire:click.prevent="selectItem({{ $item->id }}, 'update')" style="text-decoration:none;" class="text-success">
                                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg>
                                                    </div>
                                                </a>
                                                <a href="" wire:click.prevent="selectItem({{ $item->id }}, 'delete')" style="text-decoration:none;" class="text-danger">
                                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </div>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $produkProduksi->links() }}
                    </div>

                </div>
                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                    <div class="col-md-12">
                        <div class="mt-3">
                            <table class="table">
                                <thead style="font-size: 14px;">
                                    <th>No</th>
                                    <th>No PO</th>
                                    <th>Merk</th>
                                    <th>Status</th>
                                    <th>Gudang</th>
                                    <th>KB</th>
                                    <th>Model</th>
                                    <th>Bahan</th>
                                    <th>Harga Planet</th>
                                    <th>Harga TA</th>
                                    <th>Qty Seri</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($makkataclanela as $index => $item)
                                    <tr data-title="bootstrap table" data-object='{"key": "value"}'>
                                        <td style="font-size: 12px;">{{$no++}}</td>
                                        <td style="font-size: 12px;">{{$item->nomor_po}}</td>
                                        <td style="font-size: 12px;">{{$item->merk}}</td>
                                        <td style="font-size: 12px;">
                                            {{$item->nama_status}}
                                        </td>
                                        <td style="font-size: 12px;">
                                            {{$item->nama_gudang}}
                                        </td>
                                        <td style="font-size: 12px;">{{$item->kode_barang}}</td>
                                        <td style="font-size: 12px;">{{$item->kode_model}}</td>
                                        <td style="font-size: 12px;">{{$item->kode_bahan}}-{{$item->nama_bahan}}</td>
                                        <td style="font-size: 12px;">{{$item->harga_planet}}</td>
                                        <td style="font-size: 12px;">{{$item->harga_ta}}</td>
                                        <td style="font-size: 12px;">{{$item->qty_seri}}</td>
                                        <td style="font-size: 12px;">{{$item->keterangan_po}}</td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center">
                                                <a href="" wire:click.prevent="selectItem({{ $item->id }}, 'update')" style="text-decoration:none;" class="text-success">
                                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg>
                                                    </div>
                                                </a>
                                                <a href="" wire:click.prevent="selectItem({{ $item->id }}, 'delete')" style="text-decoration:none;" class="text-danger">
                                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </div>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    
                </div>

            </div>

        </div>
    </div>
    <!-- End Table -->
    <!--Delete Modal -->
    <div class="modal fade" id="modalformDelete" tabindex="-1" aria-labelledby="modalFormDeletePost" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormDeletePost">Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Yakin mau hapus?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button wire:click.prevent="delete" type="button" class="btn btn-primary">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="tambahProduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  d-block modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit In Out </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="m-3">
                                <div class="row">
                                    <div class="col">
                                        <x-jet-label>No PO</x-jet-label>
                                        <x-jet-input style="text-transform: uppercase" wire:model="nomorpo" disabled type="text" class="form-control" />
                                        @error('nomor_po') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col">
                                        <x-jet-label>Kode Supp</x-jet-label>
                                        <x-jet-input style="text-transform: uppercase" wire:model="kode_supp" disabled type="text" class="form-control" />
                                        @error('kode_supp') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="m-3">
                                <div class="row">
                                    <div class="col">
                                        <x-jet-label>Merk</x-jet-label>
                                        <x-jet-input style="text-transform: uppercase" wire:model="merk" type="text" class="form-control" disabled />
                                        @error('merk') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col">
                                        <x-jet-label>Kode Model</x-jet-label>
                                        <x-jet-input style="text-transform: uppercase" wire:model="kodemodel" type="text" class="form-control" />
                                        @error('kode_model') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="m-3">
                                <div class="row">
                                    <div class="col">
                                        <x-jet-label>Kode Barang</x-jet-label>
                                        <x-jet-input style="text-transform: uppercase" wire:model="kodebarang" type="text" class="form-control" />
                                        @error('kode_barang') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col">
                                        <x-jet-label>Qty Seri</x-jet-label>
                                        <x-jet-input wire:model="qtyseri" type="text" class="form-control" />
                                        @error('qty_seri') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="m-3">
                                <x-jet-label>Bahan</x-jet-label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <x-jet-input style="text-transform: uppercase" wire:model="kodebahan" type="text" class="form-control" placeholder="kode bahan" />
                                        @error('kode_bahan') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-sm-8">
                                        <x-jet-input wire:model="namabahan" type="text" class="form-control" placeholder="nama bahan" />
                                        @error('nama_bahan') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="m-3">
                                <x-jet-label>Harga TA</x-jet-label>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <x-jet-input style="text-transform: uppercase" wire:model="kodehargata" type="text" class="form-control" disabled />
                                            @error('harga_ta') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <x-jet-input style="text-transform: uppercase" wire:model="hargata" type="text" class="form-control" disabled />
                                            @error('harga_planet') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="m-3">
                                <x-jet-label>Harga Planet</x-jet-label>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <x-jet-input style="text-transform: uppercase" wire:model="kodehargata" type="text" class="form-control" disabled />
                                            @error('harga_ta') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <x-jet-input style="text-transform: uppercase" wire:model="hargata" type="text" class="form-control" disabled />
                                            @error('harga_planet') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>

                    <br />
                    <x-jet-button wire:click.prevent="edit">Simpan</x-jet-button>
                </div>

            </div>
        </div>
    </div>
</div>