<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    @if($btnretur === 0)
    <div style="margin-top: 200px;">
        <div class="col-md-12 text-center">
            <x-jet-button wire:click="retur">Retur</x-jet-button>
        </div>
    </div>
    @else
    <div class="row">
        <h5>List Produk Retur</h5>
    </div>

    <hr>
    <div class="row mt-3 text-center">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">
            <x-jet-label>No Surat Jalan</x-jet-label>
            <h6 class="border"><b>{{$no_sj}}</b></h6>
        </div>
        
        <x-jet-input type="hidden" />
    </div>
    <div class="row mt-3">
        <div class="col">
            <x-jet-label>Gudang Tujuan<i class="text-danger">*</i> </x-jet-label>
            <select wire:model="gudang_tujuan" name="" id="">
                <option value="" selected>Pilih</option>
                @foreach($mstgudang as $gudang)
                <option value="{{$gudang->id}}">{{$gudang->nama_gudang}}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <x-jet-label>Tanggal Retur<i class="text-danger">*</i></x-jet-label>
            <x-jet-input wire:model="tanggal_surat_jalan" type="date" />
        </div>
    </div>
    <div class="row">
        <div class="col">@error('gudang_tujuan') <span class="text-sm text-danger">{{ $message }}</span> @enderror</div>
        <div class="col">
            @error('tanggal_surat_jalan') <span class="text-sm text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="mt-3">
        <x-jet-label>Keterangan</x-jet-label>
        <x-jet-input type="text" />
    </div>

    <div class="mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th class="py-3 px-3 text-center">Kode Barang</th>
                    <th class="py-3 px-3 text-center">Qty</th>
                    <th class="py-3 px-3 text-center"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($produk_inout as $item)
                <tr>
                    <td class="py-3 px-3 text-center">{{ $item->kode_barang }}</td>
                    <td class="py-3 px-3 text-center">{{ $item->quantity }}</td>
                    <td class="py-3 px-3 text-center">
                        <button wire:click="delete({{$item->id}})" class="text-sm text-danger">hapus</button>
                    </td>
                </tr>
                @endforeach
                <tr>
                    @if($btnproses ===1)
                    <td class="py-3 px-3 text-center">Total</td>
                    <td class="py-3 px-3 text-center">{{$jumlah}}</td>
                    <td>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="row mt-3">

        <div class="col">
            @if($btnproses ===0)
            <x-jet-button wire:click="selesai">selesai</x-jet-button>
            @endif
        </div>

        @if($btnproses ===1)
        <div class="col">
            <x-jet-button wire:click="proses">Proses</x-jet-button>
        </div>
        @endif
    </div>
    @endif



</div>