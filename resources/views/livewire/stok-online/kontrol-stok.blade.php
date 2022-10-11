<div>
    <div class="">

        <div class="card-group">
            <div class="card">
                <div class="card-header">
                    Tambah Produk
                </div>
                <div class="card-body">
                    <div class="">
                        <div class="row">
                            <div class="mt-3 w-full">
                                <x-jet-label>KB</x-jet-label>
                                <x-jet-input type="text" wire:model="kode_barang" />
                            </div>
                            <div class="mt-3">
                                <x-jet-label>Kategori</x-jet-label>
                                <x-jet-input type="text" wire:model="id_kategori" />
                            </div>
                            <div class="mt-3">
                                <x-jet-label>Warna</x-jet-label>
                                <x-jet-input id="warna" type="hidden" wire:model.lazy="warna" />
                                <div wire:ignore>
                                    <select type="hidden" data-livewire="@this" class="js-select" wire:model="warna">
                                        <option value="" class="mb-2">pilih warna</option>
                                        @foreach($listwarna as $warna)
                                        <option value="{{ $warna->id }}">{{$warna->nama_warna}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mt-3">
                                <x-jet-label>Kode Merk</x-jet-label>
                                <x-jet-input wire:model="kode_merk" type="text" />
                            </div>
                        </div>
                        <div class="mt-3">
                            <table class="table table-sm text-center">
                                <thead>
                                    <tr>
                                        <th>All Size</th>
                                        <th>S</th>
                                        <th>M</th>
                                        <th>L</th>
                                        <th>XL</th>
                                        <th>XXL</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
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
                                            <button class="btn btn-sm btn-success" wire:click="tambahStok">+</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3">
                        @livewire('stok-online.input-stok-makkata')
                    </div>
                </div>
            </div>
            <div class="card card-success" style="box-shadow: none;">
                <div class="card-header text-center">
                    Input Surat Jalan Masuk
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="">
                            @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                            @endif

                            <div class="mt-1">
                                <div class="form-group">
                                    <x-jet-label>Tujuan</x-jet-label>
                                    <select class="custom-select rounded-2" wire:model.lazy="tujuan" name="" id="">
                                        <option value="">pilih</option>
                                        <option value="11">Foto</option>
                                        <option value="2">Online</option>
                                    </select>
                                    @error('tujuan') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <x-jet-label>No SJ</x-jet-label>
                                    <x-jet-input wire:model="no_sj" type="text" />
                                    @error('no_sj') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <x-jet-label>Tanggal SJ</x-jet-label>
                                    <x-jet-input wire:model="tanggal_sj" type="date" />
                                    @error('tanggal_sj') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <x-jet-label>Keterangan SJ</x-jet-label>
                                    <textarea class="form-control" rows="3" wire:model="keterangan"></textarea>
                                </div>
                            </div>

                            <div class="mt-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>KB</th>
                                            <th>Warna</th>
                                            <th>Ukuran</th>
                                            <th>Qty</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i=1;
                                        @endphp

                                        @foreach($listcart as $cart)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$cart->kode_barang}}</td>
                                            <td>{{$cart->warna->nama_warna}}</td>
                                            <td>{{$cart->ukuran->nama_ukuran}}</td>
                                            <td>{{$cart->quantity}}</td>
                                            <td><a class="text-danger" wire:click.prevent="hapusCart({{ $cart->id }})" wire:loading.attr="disabled">hapus</a> </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                <x-jet-button wire:click="simpanSuratJalan">Simpan</x-jet-button>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="row mt-3">
                    <div class="col">

                    </div>
                </div>
            </div>


        </div>

    </div>

    <div class="card  mt-3">
        <div class="card-header">
            @if (session()->has('hapus'))
            <div class="alert alert-success">
                {{ session('hapus') }}
            </div>
            @endif
            <!-- <div class="row m-4">
                <div class="col-2">
                    <x-jet-label>From</x-jet-label>
                    <x-jet-input type="date" />
                </div>
                <div class="col-4">
                    <x-jet-label>To</x-jet-label>
                    <x-jet-input type="date" />
                    <x-jet-button>Cari</x-jet-button>
                </div>
                <div class="col-6">

                </div>
            </div> -->
        </div>
    </div>


    <div class="card mt-3" style="box-shadow: none;">
        <div class="card-header">
            <div class="row">
                <div class="col m-2">SJ Masuk : {{$jumlahmasuk}}</div>
                <div class="col m-2">
                    <x-jet-input wire:model="search_masuk" type="text" style="box-shadow: none;" placeholder="cari no sj" />
                </div>
                <div class="col m-2">
                    <x-jet-button wire:click="export">export stok in</x-jet-button>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="div">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>No SJ Masuk</th>
                            <th>Qty</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $m=1;
                        @endphp
                        @foreach($datamasuk as $masuk)
                        <tr>
                            <td>{{$m++}}</td>
                            <td>{{$masuk->tanggal_sj}}</td>
                            <td>{{$masuk->no_sj}}</td>
                            <td>{{$masuk->qty}}</td>
                            <td><button wire:click="hapuspenjualan({{$masuk->id}})">hapus</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $datamasuk->links() }}
            </div>
        </div>
    </div>

    <div class="card mt-3" style="box-shadow: none;">
        <div class="card-header">
            <div class="row">
                <div class="col">SJ Keluar : {{$jumlahkeluar}}</div>
                <div class="col">
                    <x-jet-input wire:model="search_keluar" type="text" style="box-shadow: none;" placeholder="cari no sj" />
                </div>
                <div class="col m-2">
                    <x-jet-button wire:click="exportout">export stok out</x-jet-button>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="div">
                <table class="table">
                    <thead>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>No SJ Keluar</th>
                        <th>Qty</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @php
                        $k=1;
                        @endphp
                        @foreach($datakeluar as $keluar)
                        <tr>
                            <td>{{$k++}}</td>
                            <td>{{$keluar->tanggal_sj}}</td>
                            <td>{{$keluar->no_sj}}</td>
                            <td>{{$keluar->qty}}</td>
                            <td><button wire:click="hapuspenjualan({{$keluar->id}})">hapus</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $datakeluar->links() }}
            </div>
        </div>
    </div>

    <div class="card mt-3" style="box-shadow: none;">
        <div class="card-header">

            <div class="row">
                <div class="col">Penjualan : {{$jumlahpenjualan}}</div>
                <div class="col">
                    <x-jet-input wire:model="search_penjualan" type="date" style="box-shadow: none;" placeholder="cari no sj" />
                </div>
                <div class="col m-2">
                    <x-jet-button wire:click="exportpenjualan">export penjualan</x-jet-button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session()->has('hapus'))
            <div class="alert alert-success">
                {{ session('hapus') }}
            </div>
            @endif
            <div class="div">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Qty</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $p=1;
                        @endphp
                        @foreach($datapenjualan as $penjualan)
                        <tr>
                            <td>{{$p++}}</td>
                            <td>{{$penjualan->tanggal_sj}}</td>
                            <td>{{$penjualan->qty}}</td>
                            <td><button wire:click="hapuspenjualan({{$penjualan->id}})">hapus</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $datapenjualan->links() }}
            </div>
        </div>

    </div>
    <div class="card" style="box-shadow: none;">
        <div class="card-header text-center">
            @if (session()->has('pesan'))
            <div class="alert alert-success">
                {{ session('pesan') }}
            </div>
            @endif
            Input Penjualan
        </div>
        <div class="card-body text-center">
            <div class="row mt-3">
                <div class="col">
                    <x-jet-label>Tanggal</x-jet-label>
                    <x-jet-input wire:model="tanggal_penjualan" type="date" />
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <x-jet-label>Qty</x-jet-label>
                    <x-jet-input wire:model="qty_penjualan" type="number" />
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <x-jet-button wire:click="simpanpenjualan">Simpan</x-jet-button>
                </div>
            </div>
        </div>
    </div>



</div>