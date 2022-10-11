<div>
    <div class="card" style="box-shadow: none;">

        <!---TAMBAH PRODUK-->
        <div class="card-body">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif

            <div class="row m-2 float-right">
                <x-jet-input wire:model="search" type="text" style="box-shadow: none;" placeholder="cari...kb/no po/model" />
            </div>
            <table class="table ">
                <thead style="">
                    <th class="text-center">KB</th>
                    <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($listproduk as $item)
                    <tr>
                        <td class="text-center">{{$item->kode_barang}}</td>

                        <td class="text-center">
                            <button class="btn btn-sm btn-success" wire:click="tambahItem({{ $item->id }}, 'update')">+</button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
        <!---end TAMBAH PRODUK-->

        <!-- Modal -->
        <div class="modal fade" id="inputStokOnline" tabindex="-1" aria-labelledby="inputStokOnline" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inputStokOnline">Input Data Stok</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center">
                            <div class="col mt-2">
                                <x-jet-label>Lokasi</x-jet-label>
                                <x-jet-input wire:model.defer="lokasi" type="number" style="max-width: 75px; max-height: 35px;" />
                            </div>
                            <div class="col mt-2">
                                <x-jet-label>Qty</x-jet-label>
                                <x-jet-input wire:model.defer="ukuran_allsize" type="number" style="max-width: 75px; max-height: 35px;" />
                            </div>
                            <div class="col mt-2">
                                <x-jet-label>LD</x-jet-label>
                                <x-jet-input wire:model.defer="ukuran_ld" type="number" style="max-width: 75px; max-height: 35px;" />
                            </div>
                            <div class="col mt-2">
                                <x-jet-label>PB</x-jet-label>
                                <x-jet-input wire:model.defer="ukuran_pb" type="number" style="max-width: 75px; max-height: 35px;" />
                            </div>
                            <div class="col mt-2">
                                <x-jet-label>LP</x-jet-label>
                                <x-jet-input wire:model.defer="ukuran_lp" type="number" style="max-width: 75px; max-height: 35px;" />
                            </div>
                            <div class="col mt-2">
                                <x-jet-label>LPH</x-jet-label>
                                <x-jet-input wire:model.defer="ukuran_lph" type="number" style="max-width: 75px; max-height: 35px;" />
                            </div>
                            <div class="col mt-2">
                                <x-jet-label>PC/PCR</x-jet-label>
                                <x-jet-input wire:model.defer="ukuran_pc" type="number" style="max-width: 75px; max-height: 35px;" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                        <button type="button" class="btn btn-primary" wire:click="tambahCart">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>