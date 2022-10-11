<div>
    <table>
        <thead>
            <tr>
                <td><input type="text" wire:model="namawarna" class="form-control" style="max-width: 150px;">
                    @error('namawarna') <span class="text-sm text-danger">{{ $message }}</span> @enderror</td>
                <td>
                    <x-jet-button wire:click="tambahWarnas">Tambah Warna</x-jet-button>
                </td>
            </tr>
        </thead>
    </table>


</div>