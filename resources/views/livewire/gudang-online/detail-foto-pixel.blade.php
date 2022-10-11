<div>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                @if($datafoto !==null)
                <img src="{{ $datafoto->image_comp }}" class="img-fluid rounded-start" alt="{{ $datafoto->kode_barang }}">
                @else
                <img src="https://planetfashion.s3.ap-southeast-1.amazonaws.com/onprosess.jpg" class="img-fluid rounded-start">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            @if($datafoto !==null)
                            <strong>{{ $datafoto->kode_barang }}</strong>
                        </li>
                        <li>
                            <div class="row m-3">
                                <b>🌸Best Seller {{$kode_barang}}🌸</b>

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
                        </li>
                        @else
                        {{ $kode_barang }}
                        @endif
                    </ul>



                    <!--  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                </div>

            </div>
        </div>
        <div class="card-footer">
            <x-jet-button wire:click="downloadFoto"><i class="fa-solid fa-square-caret-down"></i><a style="text-decoration: none; " class="pl-1 text-white"> download foto combo</a></x-jet-button>
            <x-jet-button wire:loading wire:target="downloadFoto"><i class="fas fa-spinner fa-spin text-md"></i></x-jet-button>
            @if($datafoto !==null)
            <p class="card-text float-right"><small class="text-muted">{{ date('j F, Y, g:i A', strtotime($datafoto->updated_at))  }} - Oleh {{ $datafoto->userUpload->name }} </small></p>
            @endif
        </div>
    </div>

    <div class=" my-3">
        <div class="">
            <div class="row">
                @if($foto_satuan !== null)
                @foreach($foto_satuan as $fotos)
                <div class="col-md-3 border mt-2">
                    <img src="{{ $fotos->imagevideo_detail }}" class="img-fluid rounded-start" alt="{{ $datafoto->kode_barang }}">
                    <button class="btn mb-2 btn-sm btn-outline-secondary float-sm-right" wire:click="downloadFotoSatuan({{$fotos->id}})"><i class="fa-solid fa-square-caret-down"></i><a style="text-decoration: none; " class="pl-1 text-dark"> download</a></button>

                    <x-jet-button wire:loading wire:target="downloadFotoSatuan({{$fotos->id}})"><i class="fas fa-spinner fa-spin text-md"></i></x-jet-button>

                </div>
                @endforeach
                @endif

            </div>

        </div>

    </div>

    <div class="card">
        <div class="card-body">
            @if($datafotos !==null)
            @if($size_video !== '0 bytes')
            <div class="mt-3">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Nama file</th>
                            <th>Ukuran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $datafotos->kode_barang }}</td>
                            <td>
                                {{ $size_video }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                <x-jet-button wire:click="downloadVideo"><i class="fa-solid fa-square-caret-down"></i><a style="text-decoration: none; " class="pl-1 text-white"> download video</a></x-jet-button>

                <x-jet-button wire:loading wire:target="downloadVideo"><i class="fas fa-spinner fa-spin text-md"></i></x-jet-button>
            </div>
            @endif
            @endif
        </div>
    </div>
    <div class="card">
        <div class="card-body"></div>
    </div>

</div>