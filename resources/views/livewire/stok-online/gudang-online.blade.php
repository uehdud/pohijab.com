<div>
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
                <div class="col">
                    <x-jet-input type="search" wire:model="lokasi" placeholder="cari lokasi atau kb" />
                    <x-jet-button class="m-2" wire:click="refreshdata">refresh</x-jet-button>
                    <!-- <x-jet-button class="m-2" wire:click="uncheckSo">Uncheck</x-jet-button> -->
                </div>
                <div class="col float-right">
                    @if($lokasistok===null)
                    <x-jet-label>Jumlah Stok : {{$jumlahstok}}</x-jet-label>
                    @else
                    <x-jet-label>Jumlah Stok Lokasi {{$lokasistok}} : {{$jumlahstok}}</x-jet-label>
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
                                @if($produk->status_so === 2)
                                <button wire:click="uncheck({{$produk->id}})" class="text-success mx-1"><i class="fa-solid fa-circle-check"></i></button>
                                @else
                                <button wire:click="checkSo({{$produk->id}})" class="text-secondary mx-1"><i class="fa-solid fa-circle-check"></i></button>
                                @endif

                                <button wire:click="openupdateStok({{$produk->id}})" class="text-warning mx-1"><i class="fa-solid fa-pen"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           <!--  if($this->lokasi === null)
            datagudang->links
            endif -->
        </div>
    </div>
    <div class="modal fade" id="updateGudangOnline" tabindex="-1" aria-labelledby="updateGudangOnline" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateGudangOnline">Update Data Stok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col mt-2">
                            <x-jet-label>Lokasi</x-jet-label>
                            <x-jet-input wire:model.defer="lokasistok" type="number" style="max-width: 75px; max-height: 35px;" />
                        </div>
                        <div class="col mt-2">
                            <x-jet-label>Qty</x-jet-label>
                            <x-jet-input wire:model.defer="ukuran_allsize" type="number" style="max-width: 75px; max-height: 35px;" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                    <button type="button" class="btn btn-primary" wire:click="updateStok">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>