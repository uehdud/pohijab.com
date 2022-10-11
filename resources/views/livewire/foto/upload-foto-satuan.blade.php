<div>
    <div class="mt-3">
        <x-jet-label>Foto Satuan</x-jet-label>
        <input wire:model="foto_satuan" type="file" multiple />
    </div>
    <div class="mt-3">
        <x-jet-button wire:click.prevent="simpanFotoSatuan">Simpan</x-jet-button>
        <x-jet-button wire:loading wire:target="simpanFotoSatuan"><i class="fas fa-spinner fa-spin text-md"></i></x-jet-button>
    </div>
</div>