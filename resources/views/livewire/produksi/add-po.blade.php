<div>
    <div wire:loading>
        Processing Data...
    </div>
    <div style="text-sm">
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <form action="">
        @csrf
        <div class="px-6 py-2">
            <div class="row">
                <div class="col-sm-10">
                    <div class="" wire:ignore>
                        <x-jet-label>No PO</x-jet-label>
                        <select style="width: 40%;" data-livewire="@this" name="nopo" wire:model="datapo" class="js-select block w-52 text-gray-700 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" name="animals">
                            <option value="">
                                Pilih PO
                            </option>
                            @foreach($datapos as $item)
                            <option value="{{ $item['po']}}">
                                {{ $item['po'] }}
                            </option>
                            @endforeach
                        </select>
                        @error('datapo') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-sm btn-outline-secondary" wire:click="$refresh">
                        <i class="fa-solid fa-arrow-rotate-left"></i>
                        refresh
                    </button>
                </div>
            </div>


            <div class="mt-4">
                <x-jet-button wire:click.prevent="checkButton">Check PO</x-jet-button>
            </div>


            @if(!is_null($chekpo))
            <div class="mt-4">
                <div class="row">
                    <div class="col col-12">
                        <table style="text-align: center;" class="table border-separate border border-slate-500" id="example">
                            <thead style="font-size: 12px;">
                                <tr>
                                    <th class="border border-slate-600" scope="col">MERK</th>
                                    <th class="border border-slate-600" scope="col">SUPPLIER</th>
                                    <th class="border border-slate-600" scope="col">BAHAN</th>
                                    <th class="border border-slate-600" scope="col">MODEL</th>

                                </tr>
                            </thead>
                            <tbody style="font-size: 12px;">

                                <tr>
                                    <td class="border border-slate-600">{{$promerk}}</td>
                                    <td class="border border-slate-600">{{$proksupp}}-{{$prosupp}}</td>
                                    <td class="border border-slate-600">{{$prokbahan}}-{{$probahan}}</td>
                                    <td class="border border-slate-600">{{$prokmodel}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="row">

                    <div class="col col-3">
                        <div class=" relative ">
                            <x-jet-label>Kode Barang</x-jet-label>
                            <x-jet-input wire:model="kode_barang" type="text" class=" flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="kb" />
                            @error('kode_barang') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class=" col col-3">
                        <div class=" relative ">
                            <x-jet-label>Qty Seri</x-jet-label>
                            <x-jet-input wire:model="qty_seri" type="text" class=" flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="qty" />
                            @error('qty_seri') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col col-3">
                        <div class=" relative ">
                            <x-jet-label>Harga TA</x-jet-label>
                            <x-jet-input wire:model="harga_ta" type="text" class=" flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="X" />
                        </div>
                    </div>
                    <div class="col col-3">
                        <div class=" relative ">
                            <x-jet-label>Harga Planet</x-jet-label>
                            <x-jet-input wire:model="harga_planet" type="text" class=" flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="JX" />
                        </div>
                    </div>

                </div>
                <div class="mt-4">
                    <div class="col col-6">
                        <div class=" relative ">
                            <x-jet-label>Keterangan</x-jet-label>
                            <x-jet-input wire:model="keterangan_po" type="text-area" class=" flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" />
                        </div>
                    </div>
                </div>
            </div>






        </div>
        <div class="py-6">
            <x-jet-button wire:click.prevent="store" class=" ml-4">
                {{ __('Submit') }}
            </x-jet-button>
        </div>
        @endif


    </form>

</div>