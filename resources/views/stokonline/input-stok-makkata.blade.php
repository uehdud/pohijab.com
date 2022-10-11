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
                            <td class="text-center">
                                <x-jet-input id="warna" type="hidden" wire:model.lazy="warna" />
                                <div wire:ignore>
                                    <select type="hidden" data-livewire="@this" class="js-select" wire:model="warna">
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
</div>