<div>
    <div>
        <div class="container">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif

            <div class="row ">
                <div class="col-sm-6">
                    <div class="m-3">
                        <x-jet-label>Kode Barang</x-jet-label>
                        <x-jet-input wire:model="kode_barang" type="text" class="form-control" />
                        @error('kode_barang') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="m-3">
                        <x-jet-label>Kode Model</x-jet-label>
                        <x-jet-input wire:model="kode_model" type="text" class="form-control" />
                        @error('kode_model') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="m-3">
                        <div class="w-full ">
                            <textarea wire:model="keterangan_foto" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" name="body" placeholder='Keterangan'></textarea>
                        </div>
                    </div>
                    <!--  <div class="m-3">
                <x-jet-label>Foto Satuan</x-jet-label>
                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <x-jet-input wire:model="foto_satuans" type="file" class="form-control" multiple />

                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>
            </div>

            <div class="m-3">
                <x-jet-label>Video</x-jet-label>
                <x-jet-input wire:model="video" type="file" class="form-control" />
            </div> -->
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col">
                            @if ($photo)
                            <i class="fas fa-times-circle text-gray-500 text-lg float-right cursor-pointer" wire:click="remove"></i>
                            <div class="border" style="max-width: 500px;">
                                <img src="{{ $photo->temporaryUrl() }}">
                            </div>
                            <x-jet-button class="mt-3" wire:click.prevent="saveFotoVideoProduk">Simpan</x-jet-button>
                            <x-jet-button wire:loading wire:target="saveFotoVideoProduk"><i class="fas fa-spinner fa-spin text-md"></i></x-jet-button>

                            @else
                            <label class="text-sm font-bold text-gray-500 tracking-wide">Attach Document</label>
                            <div class="flex items-center justify-center w-full">
                                <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-60 p-100 group text-center">
                                    <div class="h-full w-full text-center flex flex-col items-center justify-center items-center  ">
                                        <div id="empty-cover-art" class="mt-4 rounded sm:w-full md:w-48 md:h-48 py-20 text-center opacity-50 md:border-solid md:border-2 md:border-gray-400">
                                            <div class="py-10"></div>
                                            <div class="py-8"></div>
                                            <svg class="mx-auto feather feather-image" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                <polyline points="21 15 16 10 5 21"></polyline>
                                            </svg>
                                        </div>
                                        <p class="pointer-none text-gray-500 "><span class="text-sm">Foto Combo PO</span> </p>
                                        <div class="py-10"></div>
                                        <div class="py-8"></div>
                                    </div>
                                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">

                                        <input type="file" wire:model="photo" class="hidden">

                                        <div x-show="isUploading">
                                            <progress max="100" x-bind:value="progress"></progress>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            @endif


                        </div>
                        <!--   <x-jet-button wire:click="simpanGambar">Upload foto Combo</x-jet-button> -->
                    </div>

                </div>
            </div>

        </div>



        <div class="row">
            <div class="col-sm-5">

            </div>


            <div class="col-sm-6  ">

            </div>
        </div>

        <br />

    </div>
</div>