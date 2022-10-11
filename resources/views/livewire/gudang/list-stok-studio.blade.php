<div>
    <div>

        <div class="card-group">
            <div class="card card-info m-0" style="box-shadow:none;">
                <div class="card-header">
                    Gudang Foto
                </div>
                <div class="card-body ">
                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-9">
                            <x-jet-input type="search" wire:model="search" placeholder="cari kode barang" />
                            <x-jet-button class="m-2" wire:click="refreshdata">refresh</x-jet-button>
                            <!--  <x-jet-button class="m-2" wire:click="uncheckSo">Uncheck</x-jet-button> -->
                        </div>
                        <div class="col-3">

                            <x-jet-label class="float-right">Jumlah Stok : {{$jumlahstokstudio}}</x-jet-label>

                            @if (session()->has('pesan'))
                            <div class="alert alert-success">
                                {{ session('pesan') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="m-3" style="padding-left:0; padding-right:0;">
                        <table class="table text-center text-sm table-sm">
                            <thead>
                                <tr>
                                    <th>Lokasi</th>
                                    <th>KB</th>
                                    <th>Warna</th>
                                    <th>Ukuran</th>
                                    <th>Stok</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datagudang as $produk)
                                <tr>
                                    <td>
                                        @if($produk->lokasi === '0')
                                        Foto
                                        @endif
                                    </td>
                                    <td>{{$produk->kode_barang}}</td>
                                    <td>{{$produk->warna->nama_warna}}</td>
                                    <td>{{$produk->ukuran->nama_ukuran}}</td>
                                    <td>

                                        {{$produk->jumlah_stok_foto}}

                                        </button>

                                    </td>
                                    <td>
                                        @can('manage-online')
                                        <button wire:click="addCart({{$produk->id}})" class="text-success "><i class="fa-solid fa-circle-plus"></i></button>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($this->lokasi === null)
                    {{ $datagudang->links() }}

                </div>
            </div>
            @can('manage-online')
            <div class="card card-info">
                <div class="card-header">
                    Buat Surat Jalan Retur
                </div>
                <div class="card-body">

                    <!--  table-cart-retur -->
                    <div x-data="{}">
                        <table class="table text-center text-sm table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>KB</th>
                                    <th>Warna</th>
                                    <th>Ukuran</th>
                                    <th>Qty</th>
                                    <th>Stok</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp

                                @foreach($products as $index => $cart)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $cart->produk['kode_barang'] ?? ''}}</td>
                                    <td>{{ $cart->produk->warna['nama_warna'] ?? ''}}</td>
                                    <td>{{ $cart->produk->ukuran['nama_ukuran'] ?? ''}}</td>
                                    <td>
                                        @if($editedProductIndex === $index || $editedProductField === $index. '.qty_cart')
                                        <input style="max-width: 50px;" type="text" @click.away="$wire.editedProductField === '{{$index}}.qty_cart' ? $wire.saveProduct({{ $index }}) : null" wire:model.defer="products.{{$index}}.qty_cart" class="text-sm rounded-lg focus:outline-none focus:border-blue-400">
                                        @if($errors->has('products.'.$index.'.qty_cart'))
                                        <div class="text-red-500">{{$errors->first('products.'.$index.'.qty_cart')}}</div>
                                        @endif
                                        @else
                                        <div class="cursor-pointer" wire:click="editProductField({{ $index }},'qty_cart')">
                                            {{ $cart['qty_cart'] }}
                                           
                                        </div>
                                        @endif

                                    </td>
                                    <td>
                                        {{ $cart->produk['jumlah_stok_online'] }}
                                    </td>
                                    <td>
                                        <button class="text-danger" wire:click="hapusCart({{$cart['id']}})"><small>hapus</small></button>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3"></td>
                                    <td>Jumlah</td>
                                    <td>{{$jumlahcart }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-cart-retur -->

                    @if($jumlahcart>0)
                    <div class="mt-3">

                        @if($selesai === 0)
                        <x-jet-button wire:click="selesaiCart">Selesai</x-jet-button>
                        @else
                        <div class="row">

                            <div class="float-left">
                                <x-jet-label>No Surat Jalan : {{$no_suratjalan}}</x-jet-label>
                                <x-jet-label>Tanggal</x-jet-label>
                                <x-jet-input wire:model="tanggal_sj" type="date" class="text-sm rounded-lg focus:outline-none focus:border-blue-400" />
                                <br> @error('tanggal_sj') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                                <x-jet-label>Keterangan</x-jet-label>
                                <textarea wire:model="keterangan_sj" type="text" class="text-sm rounded-lg focus:outline-none focus:border-blue-400"></textarea>
                                <br> @error('keterangan_sj') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <x-jet-button class="mt-3" wire:click="simpanSJ">Simpan</x-jet-button>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
        @endif
        @can('manage-online')
        <div class="card card-info mt-3">
            <div class="card-header">
                List Surat Jalan Keluar Online
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Surat Jalan</th>
                            <th>Tanggal</th>
                            <th>Jumlah Qty</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $a=1;
                        @endphp
                        @foreach($listsjretur as $sj)
                        <tr>
                            <td>{{$a++}}</td>
                            <td>{{$sj->nomor_surat_jalan}}</td>
                            <td>{{$sj->tanggal_surat_jalan}}</td>
                            <td>{{$sj->jumlah_produk}}</td>
                            <td>
                                @can('manage-online')
                                <a href="{{ route('online.sjonline.show', $sj->nomor_surat_jalan) }}" class="text-success" style="text-decoration: none;" target="blank">detail</a>
                                @endif

                                @can('manage-admingudang')
                                <a href="{{ route('admingudang.sjonline.show', $sj->nomor_surat_jalan) }}" class="text-success" style="text-decoration: none;" target="blank">detail</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $listsjretur->links() }}
        </div>
        @endif



    </div>
</div>