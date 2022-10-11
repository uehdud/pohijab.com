<div>
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="">
                    @csrf

                    <div class="px-6 py-6">
                        <div class="mt-4" wire:ignore>

                            <select style="width: 30%" data-livewire="@this" name="nopo" wire:model="datapo" class="js-select block w-52 text-gray-700 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" name="animals">
                                <option value="">
                                    Pilih PO
                                </option>
                                @foreach($datapos as $item)
                                <option value="{{ $item->po}}">
                                    {{ $item->po }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <div class="row">
                                <div class="col col-3">
                                    <div class=" relative ">
                                        <x-jet-label>Kode Barang</x-jet-label>
                                        <input wire:model="kode_barang" type="text" class=" flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="kb" />
                                    </div>
                                </div>
                                <div class="col col-2">
                                    <div class=" relative ">
                                        <x-jet-label>Qty Seri</x-jet-label>
                                        <input wire:model="qty_seri" type="text" class=" flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="qty" />
                                    </div>
                                </div>
                                <div class="col col-2">
                                    <div class=" relative ">
                                        <x-jet-label>Harga TA</x-jet-label>
                                        <input wire:model="harga_ta" type="text" class=" flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="X" />
                                    </div>
                                </div>
                                <div class="col col-2">
                                    <div class=" relative ">
                                        <x-jet-label>Harga Planet</x-jet-label>
                                        <input wire:model="harga_planet" type="text" class=" flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="JX" />
                                    </div>
                                </div>
                                <div class="col col-3">
                                    <div class=" relative ">
                                        <x-jet-label>Tanggal Kirim</x-jet-label>
                                        <input wire:model="tanggal_kirim" type="date" class=" flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" />
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">

                            </div>
                        </div>

                        <div class="mt-4">

                        </div>
                        <div class="mt-4">

                        </div>
                        <div class="mt-4">

                        </div>


                    </div>
                    <div class="py-6">
                        <x-jet-button wire:click.prevent="store" class=" ml-4">
                            {{ __('Submit') }}
                        </x-jet-button>
                    </div>

                </form>
                <div class="m-4">
                    <table style="text-align: center;" class="table border-separate border border-slate-500" id="example">
                        <thead style="font-size: 12px;">
                            <tr>
                                <th class="border border-slate-600" scope="col">NO PO</th>
                                <th class="border border-slate-600" scope="col">MERK</th>
                                <th class="border border-slate-600" scope="col">SUPPLIER</th>
                                <th class="border border-slate-600" scope="col">STATUS</th>
                                <th class="border border-slate-600" scope="col">KB</th>
                                <th class="border border-slate-600" scope="col">KODE MODEL</th>
                                <th class="border border-slate-600" scope="col">HARGA PLANET</th>
                                <th class="border border-slate-600" scope="col">HARGA TA</th>
                                <th class="border border-slate-600" scope="col">BAHAN</th>
                                <th class="border border-slate-600" scope="col">QTY SERI</th>
                                <th class="border border-slate-600" scope="col">TANGGAL DATANG</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 12px;">

                            @foreach($products as $index => $item)
                            <tr>
                                <td class="border border-slate-600">{{ $item['nopo'] }}</td>
                                <td class="border border-slate-600">{{ $item['merk'] }}</td>
                                <td class="border border-slate-600">({{ $item['kode_supp'] }}) - {{ $item['nama_supp'] }}</td>
                                <td class="border border-slate-600">{{ $item['status']}}</td>

                                <td class="border border-slate-600">
                                    @if($editedProductIndex !== $index)
                                    {{ $item['kode_barang'] }}
                                    @else
                                    <input type="text" wire:model.defer="products.{{ $index }}.kode_barang" style="max-width: 100px ;" class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded_lg border ">
                                    @endif
                                </td>
                                <td class="border border-slate-600">{{ $item['kode_model']}}</td>
                                <td class="border border-slate-600">
                                    @if($editedProductIndex !== $index)
                                    {{ $item['harga_planet'] }}
                                    @else
                                    <input type="text" wire:model.defer="products.{{ $index }}.harga_planet" style="max-width: 75px ;" class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded_lg border ">
                                    @endif
                                </td>
                                <td class="border border-slate-600">
                                    @if($editedProductIndex !== $index)
                                    {{ $item['harga_ta'] }}
                                    @else
                                    <input type="text" wire:model.defer="products.{{ $index }}.harga_ta" style="max-width: 75px ;" class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded_lg border ">
                                    @endif
                                </td>
                                <td class="border border-slate-600">({{ $item['kode_bahan']}})-{{ $item['nama_bahan'] }}</td>
                                <td class="border border-slate-600">
                                    @if($editedProductIndex !== $index)
                                    {{ $item['qty_seri'] }}
                                    @else
                                    <input type="text" wire:model.defer="products.{{ $index }}.qty_seri" style="max-width: 50px ;" class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded_lg border ">
                                    @endif
                                </td>
                                <td class="border border-slate-600">
                                    @if($editedProductIndex !== $index)
                                    {{ $item['tanggal_kirim'] }}
                                    @else
                                    <input type="date" wire:model.defer="products.{{ $index }}.tanggal_kirim" style="max-width: 100px ;" class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded_lg border ">
                                    @endif
                                </td>
                                <td class="border border-slate-600">
                                    @if($editedProductIndex !== $index)
                                    <button class="btn btn-sm btn-secondary" wire:click.prevent="editProduct({{$index}})">edit</button>
                                    @else
                                    <button class="btn btn-sm btn-success" wire:click.prevent="saveProduct({{$index}})">save</button>
                                    @endif
                                    <button class="btn btn-sm btn-danger" wire:click.prevent="delete({{ $item['id'] }})">delete</button>
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