<div>
    <div class="card" style="box-shadow: none; border:none;">
        <div class="card-header">
            ONLINE PLANET FASHION
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <ul class="list-group list-group-unbordered mb-3 text-black">
                        <li class="list-group-item">
                            <b>No Surat Jalan</b> <a class="float-right text-black" style="text-decoration: none;">{{ $datasj->nomor_surat_jalan }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Tanggal Surat Jalan</b> <a class="float-right text-black" style="text-decoration: none;">{{ $datasj->tanggal_surat_jalan }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Gudang Tujuan</b> <a class="float-right text-black" style="text-decoration: none;">{{ $datasj->toko->nama_toko}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Keterangan</b> <a class="float-right text-black" style="text-decoration: none;">{{ $datasj->keterangan_surat_jalan}}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-8"></div>
            </div>


            <table class="table table-sm text-center text-sm mt-3 table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>KB</th>
                        <th>KON</th>
                        <th>ART</th>
                        <th>KGR</th>
                        <th>MODAL</th>
                        <th>QTY</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i=1;
                    @endphp
                    @foreach($resume as $itemresume)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$itemresume->kode_barang ?? ''}}</td>
                        <td>{{$itemresume->detailProduk->kode_supp ?? ''}}</td>
                        <td>{{$itemresume->detailProduk->id_kategori ?? ''}}.{{$itemresume->detailProduk->kode_model ?? ''}}.{{$itemresume->detailProduk->kode_bahan ?? ''}}.{{$itemresume->detailProduk->kode_merk ?? ''}}</td>
                        <td>{{$itemresume->detailProduk->kategori->kode_kategori ?? ''}}</td>
                        <td>{{$itemresume->detailProduk->kode_harga_modal ?? ''}}</td>
                        <td>{{$itemresume->jumlah ?? ''}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="5"></td>
                        <td>Jumlah</td>
                        <td>{{ $datasj->jumlah_produk }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="row mt-3 text-center ">
                <div class="col"></div>
                <div class="col text-center ">

                    Tanda Terima
                    Penerima
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <small>(....................................................)</small>
                </div>
                <div class="col text-center ">


                    Penerbit Surat Jalan
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <small>(....................................................)</small><br>
                    <small>{{$userpenerbitsj->name}}</small>
                </div>
                <div class="col text-center ">


                    Penanggung Jawab Gudang
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <small>(....................................................)</small><br>
                    @can('manage-online')<small>Aziz Mujtahid</small>@endif
                </div>
                <div class="col"></div>
            </div>
        </div>
    </div>


</div>