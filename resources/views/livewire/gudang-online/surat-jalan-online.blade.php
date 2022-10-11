<div>
    <div class="card-group">
        <div class="card card-info m-0" style="box-shadow:none;">
            <div class="card-header">
                Gudang Online & Foto
            </div>
            <div class="card-body ">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif
                <div class="row">
                    <div class="col-9">
                        <x-jet-input type="search" wire:model="lokasi" placeholder="cari lokasi" />
                        <x-jet-input type="search" wire:model="search" placeholder="cari kode barang" />
                        <x-jet-button class="m-2" wire:click="refreshdata">refresh</x-jet-button>
                        <!--  <x-jet-button class="m-2" wire:click="uncheckSo">Uncheck</x-jet-button> -->
                    </div>
                    <div class="col-3">
                        @if($lokasistok === null)
                        <x-jet-label class="float-right">Jumlah Stok : {{$jumlahstok}}</x-jet-label>
                        @else
                        <x-jet-label class="float-right">Jumlah Stok Lokasi {{$lokasistok}} : {{$jumlahstok}}</x-jet-label>
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
                                <th>Qty</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datagudang as $produk)
                            <tr>
                                <td>{{$produk->lokasi}}</td>
                                <td>{{$produk->kode_barang}}</td>
                                <td>{{$produk->warna->nama_warna}}</td>
                                <td>{{$produk->ukuran->nama_ukuran}}</td>
                                <td>{{$produk->jumlah_stok_online}}</td>
                                <td>
                                    <button wire:click="addCart({{$produk->kode_barang}})" class="text-success "><i class="fa-solid fa-circle-plus"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($this->lokasi === null)
                {{ $datagudang->links() }}
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Buat Surat Jalan Retur
            </div>
            <div class="card-body">
                <table class="table text-center text-sm table-sm">
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
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td>Jumlah</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>