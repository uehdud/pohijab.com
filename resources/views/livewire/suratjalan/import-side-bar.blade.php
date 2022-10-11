<div>
    <div class="row">
        <div class="col">
            <div class="card card-warning " style="box-shadow: none;">
                <div class="card-header">
                    Import Data
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            
                                <input type="file" wire:model.defer="dataimport" name="import_file">
                                <br>
                                <x-jet-button class="mt-3" wire:click.prevent="importData">Import</x-jet-button>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                @livewire('suratjalan.list-import-produk')
            </div>
        </div>
    </div>
    
</div>