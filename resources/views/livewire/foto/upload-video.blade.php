<div>
    <div>
        <form wire:submit.prevent="uploadResume">

        </form>
        <div class="card">
            <div class="card-header">Upload Video</div>
            <div class="card-body">
                <div class="mt-3">
                    <x-jet-label>Kode Barang</x-jet-label>
                    <x-jet-input wire:model="kode_barang" type="text" />
                </div>
                <div class="mt-3">
                    <x-jet-label>Video</x-jet-label>
                    <div x-data="{ isUploading: false,  progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">

                        <input wire:model="video_produk" type="file" />

                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress" :style="`width: ${width}%; transition: width 2s;`" x-text="`${width}%`"></progress>
                        </div>
                    </div>

                </div>
                <div class="mt-3">
                    <x-jet-button wire:click.prevent="simpanVideo">Simpan</x-jet-button>
                    <x-jet-button wire:loading wire:target="simpanVideo"><i class="fas fa-spinner fa-spin text-md"></i></x-jet-button>
                </div>
            </div>
        </div>
    </div>
</div>