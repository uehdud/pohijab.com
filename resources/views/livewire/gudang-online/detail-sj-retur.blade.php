<div>
    <div class="row">
        <div class="col-3">
            <div class="card card-info" style="box-shadow: none;">
                <div class="card-header">
                    Detail Surat Jalan
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>No Surat Jalan</b> <a class="float-right" style="text-decoration: none;">{{ $datasj->nomor_surat_jalan }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Tanggal Surat Jalan</b> <a class="float-right" style="text-decoration: none;">{{ $datasj->tanggal_surat_jalan }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Jumlah Produk</b> <a class="float-right" style="text-decoration: none;">{{ $datasj->jumlah_produk }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Gudang Tujuan</b> <a class="float-right" style="text-decoration: none;">{{ $datasj->toko->nama_toko}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Keterangan</b> <a class="float-right" style="text-decoration: none;">{{ $datasj->keterangan_surat_jalan}}</a>
                        </li>
                    </ul>
                </div>

                <div class="m-3">
                    @if($statuskirim === "3")
                    <x-jet-button wire:click="kirimSj" disabled>surat jalan terkirim</x-jet-button>
                    @else
                    <x-jet-button wire:click="kirimSj">kirim surat jalan</x-jet-button>
                    @endif

                    @can('manage-admingudang')
                    <!--  <a href="{{ route('admingudang.sjout.edit', $datasj->id) }}" class="text-success" style="text-decoration: none;" target="_blank">
                        <x-jet-button class="mt-2">print detail surat jalan</x-jet-button>
                    </a> -->
                    <a href="{{ route('admingudang.printsjout.show', $datasj->id) }}" target="_blank" style="text-decoration:none;">
                        <x-jet-button class="mt-2">print resume surat jalan</x-jet-button>
                    </a>
                    @endif

                    @can('manage-online')
                    <a href="{{ route('online.sjonline.edit', $datasj->id) }}" class="text-success" style="text-decoration: none;" target="_blank">
                        <x-jet-button class="mt-2">print detail surat jalan</x-jet-button>
                    </a>
                    <a href="{{ route('online.printsjretur.show', $datasj->id) }}" target="_blank" style="text-decoration:none;">
                        <x-jet-button class="mt-2">print resume surat jalan</x-jet-button>
                    </a>
                    @endif
                </div>

            </div>




            <!-- DIRECT CHAT PRIMARY -->
            <div class="card card-info card-outline direct-chat direct-chat-primary shadow-none">
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
                                <button type="submit" class="btn btn-info text-light">Kirim</button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
        </div>

        <div class="col-md-9">
            <div class="card card-info" style="box-shadow: none;">
                <div class="card-header">
                    Produk Surat Jalan {{ $datasj->nomor_surat_jalan }}
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif

                    <div class="row m-2">
                        <div class="col">
                            <table class="table text-center text-sm">
                                <thead>
                                    <tr>
                                        <th>KB</th>
                                        <th>Qty</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <x-jet-input wire:model="kode_barang_tambah_sj" type="search" />
                                        </td>
                                        <td>
                                            <x-jet-input wire:model="qty_tambah_sj" type="search" />
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-success" wire:click="tambahItemSj">+ tambah</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="m-2">
                        <table class="table table-sm text-center text-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Warna</th>
                                    <th>Ukuran</th>
                                    <th>Qty</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach($dataproduk as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item->kode_barang}}</td>
                                    <td>{{$item->warna->nama_warna}}</td>
                                    <td>{{$item->ukuran->nama_ukuran}}</td>
                                    <td>{{$item->qty_produk}}</td>
                                    <td>{{$item->statusKirim->nama_status}}</td>
                                    <td>
                                        @if($statuskirim !== "3")
                                        @if($item->statusKirim->nama_status !== 'cancel')
                                        <button class="text-danger" wire:click="revisiSj({{$item->id}})">revisi</button>
                                        @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- DIRECT Request Revisi-->
            <div class="card card-info card-outline direct-chat direct-chat-primary shadow-none">
                <div class="card-header">
                    <h3 class="card-title">Request Revisi</h3>
                    <div class="m-2">
                        <table class="table table-sm text-center text-sm">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Warna</th>
                                    <th>Ukuran</th>
                                    <th>Qty</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($dataprodukrevisi as $item)
                                <tr>
                                    <td>{{$item->kode_barang}}</td>
                                    <td>{{$item->warna->nama_warna}}</td>
                                    <td>{{$item->ukuran->nama_ukuran}}</td>
                                    <td>{{$item->qty_produk}}</td>
                                    <td>terima tolak</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body">


                </div>
                <!-- /.card-body -->
            </div>
            <!--/.direct-request -->



            <div class="card" style="box-shadow: none;">
                <div class="card-header">
                    Revisi Surat Jalan {{ $datasj->nomor_surat_jalan }}
                </div>
                <div class="card-body">
                    <div class="m-2">
                        <table class="table table-sm text-center text-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Warna</th>
                                    <th>Ukuran</th>
                                    <th>Qty</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach($dataprodukrevisi as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item->kode_barang}}</td>
                                    <td>{{$item->warna->nama_warna}}</td>
                                    <td>{{$item->ukuran->nama_ukuran}}</td>
                                    <td>{{$item->qty_produk}}</td>
                                    <td>{{$item->statusKirim->nama_status}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card card-info" style="box-shadow: none;">
                <div class="card-header">
                    Resume Produk Surat Jalan {{ $datasj->nomor_surat_jalan }}
                </div>
                <div class="card-body">
                    <div class="m-2">
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="revisiSjRetur" tabindex="-1" aria-labelledby="revisiSjRetur" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="revisiSjRetur">Revisi {{$kodebarang}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <x-jet-label>Qty</x-jet-label>
                    <x-jet-input type="text" wire:model.defer="qty" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                    <button type="button" class="btn btn-primary" wire:click="simpanRevisi">Simpan</button>
                </div>
            </div>
        </div>
    </div>

</div>