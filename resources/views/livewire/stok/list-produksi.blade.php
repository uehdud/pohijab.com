<div>
    <div class="card" style="box-shadow: none;">
        <div class="card-header">
            <div class="w-full flex pb-10">
                <div class="w-6/12 mx-1">
                    <input wire:model.debounce.300ms="search" type="search" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded  leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Cari...">
                </div>

                <div class="w-1/6 relative mx-1">
                    <select wire:model="orderBykategori" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700  rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                        <option value="">Kategori</option>
                        @foreach($kategori as $kate)
                        <option value="{{$kate->id}}">{{$kate->kode_kategori}}-{{$kate->nama_kategori}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="w-1/6 relative mx-1">
                    <select wire:model="orderAsc" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700   rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                        <option value="1">Merk</option>
                        @foreach($merk as $mer)
                        <option value="{{ $mer->id }}">{{$mer->nama_merk}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/6 relative mx-3 mt-2">
                    <x-jet-label>Jumlah Baris</x-jet-label>
                </div>
                <div class="w-1/6 relative mx-1">
                    <select wire:model="perPage" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700  rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                </div>
                <div class="w-1/6 relative mx-3 mt-2">
                    <x-jet-label>Export</x-jet-label>
                </div>
                <div class="w-1/6 relative ml-1 mt-1">
                    <x-jet-button>excel</x-jet-button>
                    <x-jet-button>pdf</x-jet-button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-auto w-full">
                <thead class="">
                    <tr>
                        <th class="text-sm text text-center py-2">No PO
                            <span wire:click="sortPo('nomor_po')" class="float-right">
                                <small><i class="fa fa-arrow-up {{$sortColumnPo === 'nomor_po' && $sortDirection === 'asc' ? '' : 'text-muted'}}"></i> </small>
                                <small><i class="fa fa-arrow-down text-muted {{$sortColumnPo === 'nomor_po' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i> </small>
                            </span>
                        </th>
                        <th class="text-sm text-center py-2">Kode Barang
                            <span wire:click="sortPo('created_at')" class="float-right">
                                <small><i class="fa fa-arrow-up {{$sortColumnPo === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted'}}"></i> </small>
                                <small><i class="fa fa-arrow-down text-muted {{$sortColumnPo === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i> </small>
                            </span>
                        </th>
                        <th class="text-sm text-center py-2">Artikel</th>
                        <th class="text-sm text-center py-2">Kategori
                            <span wire:click="sortPo('id_kategori')" class="float-right">
                                <small><i class="fa fa-arrow-up {{$sortColumnPo === 'id_kategori' && $sortDirection === 'asc' ? '' : 'text-muted'}}"></i> </small>
                                <small><i class="fa fa-arrow-down text-muted {{$sortColumnPo === 'id_kategori' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i> </small>
                            </span>
                        </th>
                        <th class="text-sm text-center py-2">Qty Produksi
                            <span wire:click="sortPo('qty_produksi')" class="float-right">
                                <small><i class="fa fa-arrow-up {{$sortColumnPo === 'qty_produksi' && $sortDirection === 'asc' ? '' : 'text-muted'}}"></i> </small>
                                <small><i class="fa fa-arrow-down text-muted {{$sortColumnPo === 'qty_produksi' && $sortDirection === 'desc' ? '' : 'text-muted'}}"></i> </small>
                            </span>
                        </th>
                        <th class="text-sm text-center py-2">Qty Setor</th>
                        <th class="text-sm text-center py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listproduksi as $item)
                    <tr>
                        <td class="border text-center"> <button class="text-danger">{{ $item->nomor_po }}</button> </td>
                        <td class="border text-center">{{ $item->kode_barang }}</td>
                        <td class="border text-center">{{ $item->kode_supp }}.{{ $item->kode_model }}.{{ $item->kode_bahan }}.{{ $item->kode_merk }}</td>
                        <td class="border text-center">{{ $item->kategori->kode_kategori ?? ''}}</td>
                        <td class="border text-center">{{ $item->qty_produksi }}</td>
                        <td class="border text-center"></td>
                        <td class="border text-center"> <a class="text-danger" style="text-decoration: none;" target="blank" href="{{ route('gudang.stok.edit', $item->nomor_po) }}">detail</a> </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $listproduksi->links() }}
            </div>

        </div>
    </div>
</div>