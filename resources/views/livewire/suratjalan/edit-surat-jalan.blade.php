<div>

    <div class="row">

        @if (session()->has('message'))
        <div class="alert alert-success text-center m-3">
            {{ session('message') }}
        </div>
        @endif
        <div class="col-3">
            <div class="card card-success card-outline" style="box-shadow: none;">
                <div class="card-header">
                    Detail Surat Jalan
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>No Surat Jalan </td>
                                <td>: {{$datasurat->nomor_surat_jalan}}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>: {{$datasurat->tanggal_surat_jalan}}</td>
                            </tr>
                            <tr>
                                <td>Tujuan</td>
                                <td>: {{$datasurat->toko->nama_toko}} </td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>: {{$datasurat->keterangan_surat_jalan}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    @if($datasurat->status_inout === 11)
                    @if($status === 0)
                    <x-jet-button>Terima Surat Jalan</x-jet-button>
                    @endif
                    @endif
                </div>
            </div>

            <!-- DIRECT CHAT PRIMARY -->
            <div class="card card-success card-outline direct-chat direct-chat-success shadow-none">
                <div class="card-header">
                    <h3 class="card-title">Chat</h3>


                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                        <!-- Message. Default to the left -->
                        <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-left">Alexander Pierce</span>
                                <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image">
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                Is this template really for free? That's unbelievable!
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->

                        <!-- Message to the right -->
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-right">Sarah Bullock</span>
                                <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img class="direct-chat-img" src="../dist/img/user3-128x128.jpg" alt="Message User Image">
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                You better believe it!
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->
                    </div>
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts">
                        <ul class="contacts-list">
                            <li>
                                <a href="#">
                                    <img class="contacts-list-img" src="../dist/img/user1-128x128.jpg" alt="User Avatar">

                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Count Dracula
                                            <small class="contacts-list-date float-right">2/28/2015</small>
                                        </span>
                                        <span class="contacts-list-msg">How have you been? I was...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>
                            <!-- End Contact Item -->
                        </ul>
                        <!-- /.contatcts-list -->
                    </div>
                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <form action="#" method="post">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-success text-light">Kirim</button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
        </div>
        <div class="col-9">
            <div class="card card-success" style="box-shadow: none;">
                <div class="card-header text-center">

                    Produk Surat Jalan {{ $nosj }}
                </div>
                <div class="card-body">

                    <div class="">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">KB</th>
                                    <th class="text-center">Warna</th>
                                    <th class="text-center">Ukuran</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach($detailsj as $item)
                                <tr wire:key="$item->id.$item->kode_barang">
                                    <td class="text-center">{{$i++}}</td>
                                    <td class="text-center">{{$item->kode_barang}}</td>
                                    <td class="text-center">{{$item->warna->nama_warna}}</td>
                                    <td class="text-center">{{$item->ukuran->nama_ukuran}}</td>
                                    <td class="text-center">{{$item->qty_produk}}</td>
                                    <td class="text-center">
                                        @if($item->status_barang ===30)
                                        <button wire:click="tambahItem({{$item->id}}, 'detailrevisi')">Revisi diajukan</button>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->status_barang ===30)
                                        <button class="text-danger px-3" wire:click="tambahItem({{$item->id}}, 'batalrevisi')">batal</button>
                                        @else
                                        <button class=" btn btn-sm btn-success px-3" wire:click="tambahItem({{$item->id}}, 'revisi')">revisi</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="text-center">Jumlah</td>
                                    <td class="text-center">{{$jumlahtotal}}</td>
                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>

            </div>

            <div class="card card-success card-outline mt-3" style="box-shadow: none;">
                <div class="card-header text-center">
                    Resume Surat Jalan
                </div>
                <div class="card-body">
                    <table class="table table-sm text-center text-sm">
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
                                <td>{{$jumlahtotal}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="card card-secondary card-outline mt-3" style="box-shadow: none;">
                <div class="card-header text-center">

                    History Surat Jalan {{ $nosj }}
                </div>
                <div class="card-body">

                    <div class="">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">KB</th>
                                    <th class="text-center">Warna</th>
                                    <th class="text-center">Ukuran</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">User</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach($produkcancel as $item)
                                <tr wire:key="$item->id.$item->kode_barang">
                                    <td class="text-center">{{$i++}}</td>
                                    <td class="text-center">{{$item->kode_barang}}</td>
                                    <td class="text-center">{{$item->warna->nama_warna}}</td>
                                    <td class="text-center">{{$item->ukuran->nama_ukuran}}</td>
                                    <td class="text-center">{{$item->qty_produk}}</td>
                                    <td class="text-center">
                                        {{ $item->statusKirim->nama_status }}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->userInput->name ?? '' }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>

            </div>
        </div>
    </div>




    <!--modal revisi-->
    <div class="modal fade" id="revisiProdukSj" tabindex="-1" aria-labelledby="revisiProdukSj" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="revisiProdukSj">Revisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Qty Revisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <x-jet-input type="number" wire:model.defer="qty_revisi" style="max-width: 100px;" />
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                    <button type="button" class="btn btn-primary" wire:click="revisiSuratJalanMasuk">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!--modal terima-->
    <div class="modal fade" id="terimaProdukSj" tabindex="-1" aria-labelledby="terimaProdukSj" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="terimaProdukSj">Terima</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Apakah data sudah sesuai?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                    <button type="button" class="btn btn-primary" wire:click="tambahCart">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    @livewire('suratjalan.detail-revisi')

</div>