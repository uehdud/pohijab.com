<div>
    <div class="card" style="box-shadow: none;">

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
                    <th class="text-center">NO PO</th>
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
                    @if(!is_null($search))
                    @foreach($listproduk as $index => $item)
                    <tr>
                        <td class="text-center">{{$item->nomor_po}}</td>
                        <td class="text-center">{{$item->kode_barang}}</td>
                        <td class="text-center">
                            <select wire:model="warna" name="" id="">
                                <option value="">pilih</option>
                                <option value="1">Hijau</option>
                                <option value="2">Soft Beige</option>
                                <option value="3">Dusty Pink</option>
                            </select>
                        </td>
                        <td class="text-center">
                            <x-jet-input wire:model="ukuran_allsize" type="number" style="max-width: 75px; max-height: 35px;" />
                        </td>
                        <td class="text-center">
                            <x-jet-input wire:model="ukuran_s" type="number" style="max-width: 75px; max-height: 35px;" />
                        </td>
                        <td class="text-center">
                            <x-jet-input wire:model="ukuran_m" type="number" style="max-width: 75px; max-height: 35px;" />
                        </td>
                        <td class="text-center">
                            <x-jet-input wire:model="ukuran_l" type="number" style="max-width: 75px; max-height: 35px;" />
                        </td>
                        <td class="text-center">
                            <x-jet-input wire:model="ukuran_xl" type="number" style="max-width: 75px; max-height: 35px;" />
                        </td>
                        <td class="text-center">
                            <x-jet-input wire:model="ukuran_xxl" type="number" style="max-width: 75px; max-height: 35px;" />
                        </td>


                        <td class="text-center">
                            <button class="btn btn-sm btn-success" wire:click="tambahCart({{$item->kode_barang}})">+</button>
                        </td>
                    </tr>
                    <tr>
                        <td> </td>
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
                    @endif
                </tbody>
            </table>

        </div>

    </div>
</div>