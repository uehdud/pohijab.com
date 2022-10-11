<div>
    <div class="card" style="box-shadow: none; border:none;">
        <div class="card-header ">
            <h5 class="my-2"><b>{{$nomorsj}}</b> </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>No Surat Jalan </td>
                                <td>: {{$nomorsj }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>: {{$tanggalsj }}</td>
                            </tr>
                            <tr>
                                <td>Tujuan</td>
                                <td>: {{$tujuanSj }}</td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>: {{$keteranganSj }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-8"></div>
            </div>
            <table class="table mt-2 table-bordered">
                <thead class="text-center ">
                    <tr>
                        <th>NO</th>
                        <th>KB</th>
                        <th>KON</th>
                        <th>ART</th>
                        <th>KGR</th>
                        <th>MODAL</th>
                        <th>ALL SIZE</th>
                        <th>S</th>
                        <th>M</th>
                        <th>L</th>
                        <th>XL</th>
                        <th>XXL</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody class="text-center ">
                    @php
                    $i=1;
                    @endphp
                    @foreach($produksj as $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$item->kode_barang}}</td>
                        <td>{{$item->detailProduk->kode_supp}}</td>
                        <td>
                            {{$item->detailProduk->id_kategori}}.
                            {{$item->detailProduk->kode_model}}.
                            {{$item->detailProduk->kode_bahan}}.
                            {{$item->detailProduk->kode_merk}}

                        </td>
                        <td>{{$item->detailProduk->kategori->kode_kategori}}</td>
                        <td>{{$item->detailProduk->kode_harga_modal}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row mt-3 text-center ">
                <div class="col-3"></div>
                <div class="col-3 text-center ">

                    Tanda Terima
                    <br>
                    <br>
                    <br>
                    <br>
                    <small>(....................................................)</small>
                </div>
                <div class="col-3 text-center ">


                    Hormat Kami
                    <br>
                    <br>
                    <br>
                    <br>
                    <small>(....................................................)</small>
                </div>
                <div class="col-3"></div>
            </div>

        </div>
    </div>
</div>