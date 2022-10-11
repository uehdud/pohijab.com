<div>
    @if($buat_nota === 1)
    <div class="row mx-5 ">
        <div class="col-8">

        </div>
        <div class="col">
            <div class="row mt-3">
                <div class="col">
                    <x-jet-label>Tanggal Nota<i class="text-danger">*</i></x-jet-label>
                    <x-jet-input type="date" class="form-control" wire:model="tanggal_nota" />
                    @error('tanggal_nota') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col">
                    <x-jet-label>Keterangan <small><i>opsional</i></small></x-jet-label>
                    <x-jet-input type="text" class="form-control" wire:model="keterangan" />
                </div>
            </div>
        </div>

    </div>
    <div class="row mt-3 my-3">
        <div class="col">
            <x-jet-button wire:click="simpanNota" class="float-right mr-5">Simpan</x-jet-button>
            <x-jet-button wire:click="kembali" class="float-right mr-5">cancel</x-jet-button>
        </div>
    </div>
    @endif

    @if($buat_nota === 0)
    <div class="row mt-3 my-3">
        <div class="col">
            <x-jet-button wire:click="buatNota" class="float-right mr-5">Selesai</x-jet-button>
        </div>
    </div>
    @endif
</div>