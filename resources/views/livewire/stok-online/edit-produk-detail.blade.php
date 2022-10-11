<div>
    <div class="row">
        <div class="col-12 col-sm-4">
            <div class="col-12">
                <img src="{{$datastok->foto->image_comp ?? 'https://planetfashion.s3.ap-southeast-1.amazonaws.com/onprosess.jpg'}}" class="product-image" alt="Product Image">
            </div>
            <div class="col-12 ">
                <div class="row row-cols-1 row-cols-sm-3 row-cols-md-2">


                    @foreach($fotosatuan as $fotos)
                    <div class="col"><img src="{{ $fotos->imagevideo_detail ?? 'https://planetfashion.s3.ap-southeast-1.amazonaws.com/onprosess.jpg' }}" alt="Product Image"></div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-8">
            <div class="card card-secondary card-outline" style="box-shadow: none;">
                <div class="card-body">
                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif
                    <h3><strong>{{$datastok->kode_barang}}</strong></h3>
                    <table class="table">
                        <tbody>

                            <tr>
                                <td><strong>Bahan</strong></td>
                                <td>{{$datastok->detail->nama_bahan ?? ''}}</td>
                            </tr>
                            <tr>
                                @if(!$editlokasi)
                                <td><strong>Lokasi</strong></td>
                                @if($datastok->lokasi === "0")
                                <td>Foto</td>
                                @else
                                <td>{{$datastok->lokasi}}</td>
                                @endif

                                <td>
                                    <button class="text-danger" wire:click="editLokasi">edit</button>
                                </td>
                                @else
                                <td><strong>Lokasi</strong></td>
                                <td><input type="text" wire:model="lokasi" class="form-control"></td>
                                <td>
                                    <x-jet-button wire:click="updateLokasi">update</x-jet-button>
                                </td>
                                @endif
                            </tr>
                            <tr>
                                <td><strong>Harga Up 30%</strong></td>
                                <td>{{$hargaup}}</td>
                            </tr>
                            <tr>
                                <td><strong>Harga Normal (JX)</strong></td>
                                <td>{{$hargajx}}</td>
                            </tr>
                            <tr>
                                <td><strong>Harga Grosir(X)</strong></td>
                                <td>{{$hargax}}</td>
                            </tr>
                            <tr>
                                <td><strong>Seri Warna</strong></td>
                                <td>{{$datastok->detail->keterangan_po ?? ''}}</td>

                                <td colspan="2">@livewire('stok-online.tambah-warna')</td>

                            </tr>

                            @if($totalstok < $datastok->jumlah_stok_online)
                                <tr>

                                    <td></td>

                                    <td>
                                        <x-jet-input id="warna" type="hidden" wire:model.lazy="warna" style="max-width: 150px;" />
                                        <div wire:ignore style="max-width: 150px;">
                                            <select type="hidden" data-livewire="@this" class="js-select" wire:model="warna" style="max-width: 150px;">
                                                <option value="" class="mb-2">pilih warna</option>
                                                @foreach($listwarna as $warna)
                                                <option value="{{ $warna->id }}">{{$warna->nama_warna}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @error('warna') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                                    </td>

                                    <td>
                                        <input wire:model="qtytambahstok" type="text" class="form-control" placeholder="qty" style="max-width: 100px;" />
                                        @error('qtytambahstok') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                                    </td>
                                    <td>
                                        <x-jet-button wire:click="tambahStok">Tambah Stok</x-jet-button>
                                    </td>
                                </tr>
                                @endif
                                @foreach($liststok as $stok)
                                <tr>
                                    <td></td>
                                    <td><strong>{{$stok->warna->nama_warna}}</strong></td>
                                    <td>{{ $stok->stok }}</td>
                                    <td><button wire:click="hapusStokWarna({{$stok->id}})" class="text-danger text-sm">hapus</button></td>
                                </tr>
                                @endforeach

                                <tr>
                                    <td></td>
                                    <td><strong>Jumlah Stok</strong></td>
                                    <td>{{$datastok->jumlah_stok_online}}</td>
                                </tr>
                        </tbody>
                    </table>
                    <table class="table text-center text-sm table-sm table-bordered">
                        <thead>
                            <tr>
                                <td>LD</td>
                                <td>PB</td>
                                <td>LP</td>
                                <td>LPH</td>
                                <td>PCR</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @if($detail === 0)
                            <tr>
                                <td><input type="text" wire:model="ukuran_ld" class="form-control" placeholder="ld"></td>
                                <td><input type="text" wire:model="ukuran_pb" class="form-control" placeholder="pb"></td>
                                <td><input type="text" wire:model="ukuran_lp" class="form-control" placeholder="lp"></td>
                                <td><input type="text" wire:model="ukuran_lph" class="form-control" placeholder="lph"></td>
                                <td><input type="text" wire:model="ukuran_pc" class="form-control" placeholder="pc/pcr"></td>
                                <td>
                                    <x-jet-button wire:click="tambahUkuran">+</x-jet-button>
                                </td>
                            </tr>
                            @else
                            <tr>@if(!$editukuran)
                                <td>{{$datastok->detailukuran->ukuran_ld ?? ''}}</td>
                                <td>{{$datastok->detailukuran->ukuran_pb ?? ''}}</td>
                                <td>{{$datastok->detailukuran->ukuran_lp ?? ''}}</td>
                                <td>{{$datastok->detailukuran->ukuran_lph ?? ''}}</td>
                                <td>{{$datastok->detailukuran->ukuran_pc ?? ''}}</td>
                                <td>
                                    <button class="text-danger text-sm" wire:click="editUkuran">edit</button>
                                </td> @else
                                <td><input type="text" class="form-control" wire:model="ukuran_ld"></td>
                                <td><input type="text" class="form-control" wire:model="ukuran_pb"></td>
                                <td><input type="text" class="form-control" wire:model="ukuran_lp"></td>
                                <td><input type="text" class="form-control" wire:model="ukuran_lph"></td>
                                <td><input type="text" class="form-control" wire:model="ukuran_pc"></td>
                                <td> <button class="text-success text-sm" wire:click="updateUkuran">simpan</button> </td>



                                @endif
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="mt-3">
                <div class="card card-secondary card-outline" style="box-shadow: none;">
                    <div class="card-body">
                        @if(!$editdeskripsi)
                        <button wire:click="editDeskripsi" class="text-danger text-sm float-right"><i class="fa-regular fa-pen-to-square"></i> edit</button>
                        @endif
                        <div class="row m-3">
                            <b>🌸Best Seller {{$datastok->kode_barang}}🌸</b>


                            <x-jet-label class="mt-3">Harga Normal: {{$hargaup}}</x-jet-label>
                            <x-jet-label>Harga Grosir: {{$hargax}} <i>(minimal pembelian 4pcs)</i></x-jet-label>
                            <x-jet-label>Detail Material : {{$datastok->detail->nama_bahan ?? ''}}</x-jet-label>
                            <x-jet-label>
                                @if(!$editdeskripsi)
                                {{ $datastok->detailukuran->deskripsi ?? '' }}
                                @else
                                <textarea name="" id="" cols="100" rows="15" wire:model="deskripsi"></textarea>
                                <x-jet-button wire:click="updateDeskripsi">simpan</x-jet-button>
                                @endif
                            </x-jet-label>
                            <x-jet-label>Pilihan Warna : {{$datastok->detail->keterangan_po ?? ''}}</x-jet-label>
                            <x-jet-label>✂ UKURAN {{$datastok->detail->kategori->nama_kategori ?? ''}} ✂</x-jet-label>
                            <x-jet-label>Lingkar Dada : {{$ukuran_ld}}</x-jet-label>
                            <x-jet-label>Panjang Produk : {{$ukuran_pb}}</x-jet-label>
                            <x-jet-label>Lebar Pinggang : {{$ukuran_lp}}</x-jet-label>
                            <x-jet-label>Panjang Celana : {{$ukuran_pc}}</x-jet-label>
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
                </div>
            </div>
        </div>
    </div>
    <img>
</div>