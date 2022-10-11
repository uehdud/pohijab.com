<div>
    <div class="card card-secondary card-outline m-0" style="box-shadow:none;">
        <div class="card-header">
            Stok Makkata Online ({{ $jumlah }})
            <x-jet-input type="search" wire:model="search" placeholder="cari kb / model / nama cantik" class="float-right" />
        </div>
        <div class="card-body" style="box-shadow: none;">
            <div class="row from-control">
                @foreach($datagudang as $index => $item)
                <div class="col-md-3 col-sm-6 col-12 m-auto">

                    <div class="card">
                        <a href="#" style="box-shadow: none;" class="text-black">
                            <img style="box-shadow: none;" src="{{$item->file_comp_a ?? 'https://planetfashion.s3.ap-southeast-1.amazonaws.com/onprosess.jpg'}}" class="card-img-top" alt="...">
                        </a>

                        <div class="card-body" style="box-shadow: none;">
                            @livewire('stok-online.detail-stok', ['kode_barang'=>$item->kode_barang, 'warna_id'=>$item->warna_id, key($item->id.$index)])
                            <table class="table text-sm table-sm">
                                <thead>
                                    <tr>
                                        <th>
                                            {{$item->kode_barang}} - Lokasi {{ $item->lokasi }}
                                        </th>
                                        @if($item->foto_id !== null)
                                        <th><button class="text-danger" wire:click="tambahFoto({{$item->id}})"><i class="fa-solid fa-arrows-rotate"></i></button></th>
                                        @else

                                        <th><button class="text-success" wire:click="tambahFoto({{$item->id}})"><i class="fa-solid fa-arrow-right-to-bracket"></i> Tambah Foto</button></th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $item->nama_cantik ?? '' }} - <b>{{ $item->kode_model }}</b> </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            {{ $item->nama_warna }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-auto" style="border-bottom: none;"><small>JX {{ $item->harga_planet }}</small></td>

                                    </tr>
                                    <tr>
                                        <td class="p-auto" style="border-bottom: none;"><small>X {{ $item->harga_ta }} </small></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>




                    </div>

                </div>
                @endforeach

            </div>
            {{ $datagudang->links() }}
            <div class="modal fade" id="updateGudangOnline" tabindex="-1" aria-labelledby="updateGudangOnline" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateGudangOnline">List Foto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                @foreach($datasearchfoto as $fotos)
                                <div class="col-12 col-md-3 col-sm-6 m-auto">
                                    <div class="card" style="box-shadow: none;">
                                        <a href="#" class="text-black">
                                            <img style="box-shadow: none;" src="{{$fotos->file_comp_c ?? 'https://planetfashion.s3.ap-southeast-1.amazonaws.com/onprosess.jpg'}}" class="card-img-top">
                                        </a>
                                        <div class="card-body" style="box-shadow: none;">
                                            <div class="form-check">
                                                <input class="form-check-input" wire:model.defer="foto_id" type="checkbox" value="{{$fotos->id}}" id="flexCheckDefault">


                                                <table class="table text-sm">
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $fotos->nama_cantik ?? '' }} - {{ $fotos->nama_warna }}</td>

                                                        </tr>
                                                        <tr>
                                                            <td> <b>{{ $fotos->kode_model ?? '' }}</b> </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                            <button type="button" class="btn btn-primary" wire:click="updateFoto">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

</div>