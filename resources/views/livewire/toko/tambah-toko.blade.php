<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <x-jet-button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahToko">Tambah Toko</x-jet-button>
    <div class="row m-3">
        <div class="col">
            <table class="table table-sm table-responsive-sm">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama </th>
                        <th>Alamat</th>
                        <th>Kontak</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($listtoko as $index => $item)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$item->nama_toko}}</td>
                        <td>{{$item->alamat_toko}}</td>
                        <td>{{$item->kontak_toko}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div wire:ignore.self class="modal  fade" id="tambahToko" tabindex="-1" aria-labelledby="tambahToko" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahToko">Tambah Toko</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <x-jet-label>Nama Toko</x-jet-label>
                            <x-jet-input wire:model="nama_toko" type="text" />
                            @error('nama_toko') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <x-jet-label>Alamat Toko</x-jet-label>
                            <x-jet-input wire:model="alamat_toko" type="text" />
                            @error('alamat_toko') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col">
                            <x-jet-label>Kontak Toko</x-jet-label>
                            <x-jet-input wire:model="kontak_toko" type="text" />
                            @error('kontak_toko') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="createToko" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>




</div>