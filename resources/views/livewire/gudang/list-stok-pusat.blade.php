<div>
    <div class="card">
        <div class="card-header text-center">
            List Stok Gudang (GSP)
        </div>
        <div class="card-body">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
            <div class="row m-2 float-right">
                <x-jet-input wire:model="search" type="text" placeholder="search..." />
            </div>
            <table class="table ">
                <thead style="">
                    <th class="text-center">KB</th>
                    <th class="text-center">STOK</th>
                    <th class="text-center">QTY</th>
                    <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @if(!is_null($search))
                    @foreach($datainout as $index => $item)
                    <tr>
                        <td class="text-center" style="">{{$item->kode_barang}}</td>
                        <td class="text-center" style="">{{$item->total_stok}}</td>
                        <td class="text-center" style="">
                            <x-jet-input wire:model="qty" type="number" style="max-width: 75px; max-height: 35px;" />
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-success" wire:click="tambahCart({{$item->kode_barang}})">+</button>
                        </td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td> </td>
                        <td class="text-center"> @error('qty') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                        </td>
                        <td> </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>

        </div>

    </div>
</div>