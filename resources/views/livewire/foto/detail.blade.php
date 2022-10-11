<div>
    <div>
        <div class="card">
            <div class="card-header">
                Detail Foto
            </div>
            <div class="card-body">
                <div class="row p-3">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-sm-6 border-right">
                                @if($datafotos->image_comp !== null)
                                <img src="{{$datafotos->image_comp}}" alt="" width="300" height="300">
                                <div class="mt-2">
                                    <x-jet-button wire:click="downloadFoto"><i class="fa-solid fa-square-caret-down"></i><a style="text-decoration: none; " class="pl-1 text-white"> download</a></x-jet-button>
                                    <x-jet-button wire:click="deleteCombo({{$datafotos->id}})"><i class="fa-solid fa-trash-can"></i><a style="text-decoration: none; " class="pl-1 text-white"> hapus</a></x-jet-button>
                                    <x-jet-button wire:loading wire:target="downloadFoto"><i class="fas fa-spinner fa-spin text-md"></i></x-jet-button>
                                </div>
                                @else
                                @if ($photo)
                                <i class="fas fa-times-circle text-gray-500 text-lg float-right cursor-pointer" wire:click="remove"></i>
                                <div class="border" style="max-width: 500px;">
                                    <img src="{{ $photo->temporaryUrl() }}">
                                </div>
                                <x-jet-button class="mt-3" wire:click.prevent="saveFotoVideoProduk">Simpan</x-jet-button>
                                <x-jet-button wire:loading wire:target="saveFotoVideoProduk"><i class="fas fa-spinner fa-spin text-md"></i></x-jet-button>
                                @else
                                <label class="text-sm font-bold text-gray-500 tracking-wide">Attach Foto</label>
                                <div class="flex items-center justify-center w-full">
                                    <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-50 p-80 group text-center">
                                        <div class="h-full w-full text-center flex flex-col items-center justify-center items-center  ">
                                            <div id="empty-cover-art" class="mt-4 rounded sm:w-full md:w-48 md:h-48 py-20 text-center opacity-50 md:border-solid md:border-2 md:border-gray-400">
                                                <div class="py-6"></div>
                                                <div class="py-6"></div>
                                                <svg class="mx-auto feather feather-image" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                    <polyline points="21 15 16 10 5 21"></polyline>
                                                </svg>
                                            </div>
                                            <p class="pointer-none text-gray-500 "><span class="text-sm">Foto Combo PO</span> </p>
                                            <div class="py-6"></div>
                                            <div class="py-6"></div>
                                        </div>
                                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">

                                            <input type="file" wire:model="photo" class="hidden">

                                            <div x-show="isUploading">
                                                <div class="row">
                                                    <div class="col">
                                                        <progress max="100" x-bind:value="progress"></progress>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group input-group-sm mb-3" style="border: none; width:100px;">
                                                            <input type="text" x-bind:value="progress" class="form-control" disabled>
                                                            <span class=" input-group-text">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                @endif
                                @endif
                            </div>
                            <div class="col-sm-6 border-right">
                                @if($datafotos->video_produk !== null)
                                <div class="mt-3">
                                    <table class="table">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nama file</th>
                                                <th>Ukuran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $datafotos->kode_barang }}</td>
                                                <td>
                                                    {{ $size_video }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-2">
                                    <x-jet-button wire:click="downloadVideo"><i class="fa-solid fa-square-caret-down"></i><a style="text-decoration: none; " class="pl-1 text-white"> download</a></x-jet-button>
                                    <x-jet-button wire:click="deletevideo({{$datafotos->id}})"><i class="fa-solid fa-trash-can"></i><a style="text-decoration: none; " class="pl-1 text-white"> hapus</a></x-jet-button>
                                    <x-jet-button wire:loading wire:target="downloadVideo"><i class="fas fa-spinner fa-spin text-md"></i></x-jet-button>
                                    <x-jet-button wire:loading wire:target="deletevideo"><i class="fas fa-spinner fa-spin text-md"></i></x-jet-button>
                                </div>
                                @else

                                <div class="flex items-center justify-center w-full">
                                    <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-50 p-80 group text-center">
                                        <div class="h-full w-full text-center flex flex-col items-center justify-center items-center  ">
                                            <div id="empty-cover-art" class="mt-4 rounded sm:w-full md:w-48 md:h-48 py-20 text-center opacity-50 md:border-solid md:border-2 md:border-gray-400">
                                                <div class="py-6"></div>

                                                <svg class="mx-auto feather feather-image" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                    <polyline points="21 15 16 10 5 21"></polyline>
                                                </svg>
                                            </div>
                                            <p class="pointer-none text-gray-500 "><span class="text-sm">Video PO</span> </p>

                                        </div>
                                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">

                                            <input wire:model="video_produk" type="file">

                                            <div x-show="isUploading">
                                                <div class="row">
                                                    <div class="col">
                                                        <progress max="100" x-bind:value="progress"></progress>
                                                        <i max="100" x-bind:value="progress"></i>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group input-group-sm mb-3" style="border: none; width:100px;">
                                                            <input type="text" x-bind:value="progress" class="form-control" disabled>
                                                            <span class=" input-group-text">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="py-6"></div>
                                    </label>
                                </div>
                                <x-jet-button class="mt-3" wire:click.prevent="simpanVideo">Simpan</x-jet-button>
                                <x-jet-button wire:loading wire:target="simpanVideo"><i class="fas fa-spinner fa-spin text-md"></i></x-jet-button>
                                @endif


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <x-jet-label>Kode Barang</x-jet-label>
                            <x-jet-input type="text" wire:model="kode_barang" disabled />
                        </div>
                        <div class="row mt-3">
                            <x-jet-label>Model</x-jet-label>
                            <x-jet-input type="text" wire:model="kode_model" disabled />
                        </div>

                    </div>

                </div>

            </div>

        </div>
        <div class="card mt-3">
            <div class="card-header">
                Foto Detail Satuan
            </div>
            <div class="card-body">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif
                <div class="mt-3">
                    <x-jet-label>Foto Satuan</x-jet-label>
                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">

                        <input wire:model="foto_satuan" type="file" multiple />

                        <div x-show="isUploading">
                            <div class="row">
                                <div class="col-sm-2">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm mb-3 float-left" style="border: none; width:100px;">
                                        <input type="text" x-bind:value="progress" class="form-control" disabled>
                                        <span class=" input-group-text">%</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <x-jet-button wire:click.prevent="simpanFotoSatuan">Simpan</x-jet-button>
                    <x-jet-button wire:loading wire:target="simpanFotoSatuan"><i class="fas fa-spinner fa-spin text-md"></i></x-jet-button>
                </div>


            </div>
        </div>
    </div>