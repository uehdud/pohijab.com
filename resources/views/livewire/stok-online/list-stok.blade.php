<div>
    <!-- /.col -->
    <div class="col-md-12">
        <div class="card " style="box-shadow:none;">
            <div class="card-header">
                <div class="row">

                    <div class="col m-2"><b>List Stok Produk Planet</b></div>
                    <div class="col m-2">Jumlah Stok: {{ $jumlahstok }}</div>
                </div>


            </div>
            <div class="card-header">
                <div class="col">
                    <x-jet-input wire:model="search" type="search" style="box-shadow: none;" placeholder="cari" />
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">

                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Lokasi</th>
                                    <th>Merk</th>
                                    <th>Kode Barang</th>
                                    <th>Harga JX</th>
                                    <th>Harga X</th>
                                    <th>Qty</th>
                                    <th>LD</th>
                                    <th>PB</th>
                                    <th>LP</th>
                                    <th>LPH</th>
                                    <th>PC/PCR</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach($datastok as $item)
                                <tr>
                                    <td>{{$item->lokasi}}</td>
                                    <td>{{$item->merk}}</td>
                                    <td>{{$item->kode_barang}}</td>
                                    <td>{{$item->harga_planet}}</td>
                                    <td>{{$item->harga_ta}}</td>
                                    <td>{{$item->jumlah_stok_online}}</td>
                                    <td>{{$item->ukuran_ld}}</td>
                                    <td>{{$item->ukuran_pb}}</td>
                                    <td>{{$item->ukuran_lp}}</td>
                                    <td>{{$item->ukuran_lph}}</td>
                                    <td>{{$item->ukuran_pc}}</td>


                                    <td>
                                        <button class="text-danger" style="text-decoration: none;" wire:click="tambahItem({{ $item->id }}, 'update')">edit</button>
                                        <button class="text-warning" style="text-decoration: none;" wire:click="tambahItem({{ $item->id }}, 'deskripsi')"> deskripsi</button>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $datastok->links() }}

                    </div>
                    <!-- /.tab-pane -->

                    <!-- /.tab-pane -->


                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="card card-info">
            <div class="card-header">
                Foto Produk
            </div>
            <div class="card-body" id="timeline">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @foreach($listfotopo as $item)
                    <div class="col">
                        <div class="card" style="box-shadow: none;">
                            @if($item->image_comp !== null)
                            <img class="card-img-top" src={{ $item->image_comp }} alt="{{ $item->kode_barang }}">
                            @else
                            <img class="card-img-top" src="https://planetfashion.s3.ap-southeast-1.amazonaws.com/onprosess.jpg" alt="{{ $item->kode_barang }}">
                            @endif
                            <div class="card-body pt-3">
                                <ul class="list-group list-group-flush ">
                                    <li class="list-group-item  pt-0">
                                        <div class="col ">
                                            <h6 class="card-title "><b>{{ $item->kode_barang }}</b></h6>
                                        </div>
                                        <div class="col ">
                                            <h6 class="card-title pt-0 float-right "><b>{{ $item->kode_model }}</b></h6>
                                        </div>
                                    </li>
                                    <li class="list-group-item py-0"></li>
                                </ul>
                                <div class="row">

                                </div>
                            </div>

                            <a style="text-decoration: none;" class="text-black" href="{{ route('foto.fotos.show', $item->kode_barang) }}">
                                <div class="card-footer text-center">
                                    Detail
                                </div>
                            </a>


                        </div>
                    </div>
                    @endforeach

                </div>
                {{ $listfotopo->links()  }}
            </div>
        </div>
    </div>
    <!-- /.col -->
    <div class="card" style="box-shadow:none;">


    </div>
    <!-- Modal -->
    <div class="modal fade" id="editStokOnline" tabindex="-1" aria-labelledby="editStokOnline" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStokOnline">Input Data Stok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col mt-2">
                            <x-jet-label>Lokasi</x-jet-label>
                            <x-jet-input wire:model.defer="lokasi" type="text" style="max-width: 75px; max-height: 35px;" />
                        </div>
                        <div class="col mt-2">
                            <x-jet-label>Qty</x-jet-label>
                            <x-jet-input wire:model.defer="edit_allsize" type="text" style="max-width: 75px; max-height: 35px;" />
                        </div>
                        <div class="col mt-2">
                            <x-jet-label>LD</x-jet-label>
                            <x-jet-input wire:model.defer="ukuran_ld" type="text" style="max-width: 75px; max-height: 35px;" />
                        </div>
                        <div class="col mt-2">
                            <x-jet-label>PB</x-jet-label>
                            <x-jet-input wire:model.defer="ukuran_pb" type="text" style="max-width: 75px; max-height: 35px;" />
                        </div>
                        <div class="col mt-2">
                            <x-jet-label>LP</x-jet-label>
                            <x-jet-input wire:model.defer="ukuran_lp" type="text" style="max-width: 75px; max-height: 35px;" />
                        </div>
                        <div class="col mt-2">
                            <x-jet-label>LPH</x-jet-label>
                            <x-jet-input wire:model.defer="ukuran_lph" type="text" style="max-width: 75px; max-height: 35px;" />
                        </div>
                        <div class="col mt-2">
                            <x-jet-label>PC/PCR</x-jet-label>
                            <x-jet-input wire:model.defer="ukuran_pc" type="text" style="max-width: 75px; max-height: 35px;" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                    <button type="button" class="btn btn-primary" wire:click="simpaneditStok">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deskripsiStokOnline" tabindex="-1" aria-labelledby="deskripsiStokOnline" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deskripsiStokOnline">Input Data Stok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row m-3">
                        <x-jet-label>Deskripsi</x-jet-label>
                        <textarea wire:model.defer="deskripsi" class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" name="body"></textarea>
                    </div>
                    <div class="row m-3">
                        <b>🌸Best Seller {{$kb}}🌸</b>

                        <x-jet-label class="mt-3">Harga Normal: {{$hargaup}}</x-jet-label>
                        <x-jet-label>Harga Grosir: {{$hargata}} <i>(minimal pembelian 4pcs)</i></x-jet-label>
                        <x-jet-label>Detail Material : {{$bahan}}</i></x-jet-label>
                        <x-jet-label> {{$deskripsi}}</i></x-jet-label>
                        <x-jet-label>Pilihan Warna : {{$warna}}</i></x-jet-label>
                        <x-jet-label>✂ UKURAN {{ $namakategori }} ✂</i></x-jet-label>
                        <x-jet-label>Lingkar Dada : {{$ukuran_ld}}</i></x-jet-label>
                        <x-jet-label>Panjang Produk : {{$ukuran_pb}} </i></x-jet-label>
                        <x-jet-label>Lebar Pinggang : {{$ukuran_lp}} </i></x-jet-label>
                        <x-jet-label>Panjang Celana : {{$ukuran_pc}}</i></x-jet-label>
                        <p>Pengiriman
                            Senin - Sabtu : 15.00 WIB <br>
                            Minggu : Tidak ada pengiriman <br>
                            ________<br>
                            <br>
                            Notes :<br>
                            > Wajib Konfirmasi Ketersediaan stock & warna terlebih dahulu sebelum order<br>
                            > Tidak dapat ganti size atau artikel lainnya, kecuali kesalahan dari kami seperti barang yang kami kirim Cacat / Salah barang<br>
                            > Untuk Klaim Retur Customer wajib mengirimkan Video Unboxing paket Tanpa Pause, max 3hari setelah barang diterima<br>
                            > Order sebelum jam 15.00 Pesananan akan dikirim dihari yang sama Kecuali hari Libur<br>
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                    <button type="button" class="btn btn-primary" wire:click="simpandeskripsi">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>