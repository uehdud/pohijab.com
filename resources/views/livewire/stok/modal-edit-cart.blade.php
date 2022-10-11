<div>
    <x-jet-button wire:click="simpanEdit">
        test
    </x-jet-button>
    <p class="text-success" type="button" data-bs-toggle="modal" data-bs-target="#editStokCart"><small><i class="fa-solid fa-pen-to-square"></i>edit</small></p>
    <!-- Modal -->
    <div class="modal fade" id="editStokCart" tabindex="-1" aria-labelledby="editStokCart" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStokCart">Edit {{$datakb}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mt-1 text-center">
                            <x-jet-label>All Size</x-jet-label>
                            <x-jet-input style="max-width: 75px;" type="text" wire:model.defer="edit_allsize" />
                        </div>
                        <div class="col mt-1 text-center">
                            <x-jet-label>S</x-jet-label>
                            <x-jet-input style="max-width: 75px;" type=" text" wire:model.defer="edit_s" />
                        </div>
                        <div class="col mt-1 text-center">
                            <x-jet-label>M</x-jet-label>
                            <x-jet-input style="max-width: 75px;" type=" text" wire:model.defer="edit_m" />
                        </div>
                        <div class="col mt-1 text-center">
                            <x-jet-label>L</x-jet-label>
                            <x-jet-input style="max-width: 75px;" type=" text" wire:model.defer="edit_l" />
                        </div>
                        <div class="col mt-1 text-center">
                            <x-jet-label>XL</x-jet-label>
                            <x-jet-input style="max-width: 75px;" type=" text" wire:model.defer="edit_xl" />
                        </div>
                        <div class="col mt-1 text-center">
                            <x-jet-label>XXL</x-jet-label>
                            <x-jet-input style="max-width: 75px;" type="text" wire:model.defer="edit_xxl" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" wire:click="simpanEdit">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>