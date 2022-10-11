<div>
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-secondary card-outline" style="box-shadow: none;">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class=" img-fluid " src="{{$foto}}" alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center"><b>{{ $kb }}</b></h3>

                    <p class="text-muted text-center">{{$kode_supp}}.{{$kode_model}}.{{$kode_bahan}}.{{$kode_merk}}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Nomor PO</b> <a style="text-decoration: none;" class="float-right text-black">{{$nomorpo}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Merk</b> <a style="text-decoration: none;" class="float-right text-black">{{ $merk }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Supplier</b> <a style="text-decoration: none;" class="float-right text-black">{{ $kode_supp }}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Jumlah Produksi</b> <a style="text-decoration: none;" class="float-right text-black">{{ $qtyproduksi}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Jumlah Setor</b> <a style="text-decoration: none;" class="float-right text-black">{{ $jumlahsetor}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Jumlah Cacat/Retur</b> <a style="text-decoration: none;" class="float-right text-black">{{ $cacat}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Sisa</b> <a style="text-decoration: none;" class="float-right text-black">{{ $sisa}}</a>
                        </li>
                    </ul>


                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-secondary" style="box-shadow: none;">
                <div class="card-header">
                    <h3 class="card-title">Detail</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong>Kategori</strong>

                    <p class="text-muted">
                        {{$kategori}}
                    </p>

                    <hr>
                    <strong>Bahan</strong>

                    <p class="text-muted">
                        {{$namabahan}}
                    </p>

                    <hr>

                    <strong>Harga Modal</strong>

                    <p class="text-muted">{{ $kode_harga_modal }}</p>

                    <hr>

                    <strong>Harga Tanah Abang</strong>

                    <p class="text-muted">{{ $kode_harga_ta }}</p>

                    <hr>
                    <strong>Harga Planet</strong>

                    <p class="text-muted">{{ $kode_harga_planet }}</p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Keterangan</strong>

                    <p class="text-muted">{{ $keterangan ?? '' }}</p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card card-secondary card-outline" style="box-shadow: none;">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif
                <div class="card-header text-center">
                    In Out Barang
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            @if($kode_merk === 'A' || $kode_merk === 'CL' )
                            <table class="table table-bordered mb-0">
                                <thead class="bg-gray-500 text-light">
                                    <tr>
                                        <th class="text-sm text-center border-1 py-2" style="width: 100px;">Warna</th>
                                        <th class="text-sm text-center border-1 py-2" style="width: 100px;">ALL SIZE</th>
                                        <th class="text-sm text-center border-1 py-2" style="width: 50px;">S</th>
                                        <th class="text-sm text-center border-1 py-2" style="width: 50px;">M</th>
                                        <th class="text-sm text-center border-1 py-2" style="width: 50px;">L</th>
                                        <th class="text-sm text-center border-1 py-2" style="width: 50px;">XL</th>
                                        <th class="text-sm text-center border-1 py-2" style="width: 75px;">XXL</th>
                                        <th class="text-sm text-center border-1 py-2" style="width: 100px;">Jumlah</th>
                                        <th class="text-sm text-center border-1 py-2" style="width: 150px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            @else
                            <div class="m-3 form-horizontal">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input wire:model="tanggal_nota" type="date" class="form-control">
                                    </div>
                                    @error('tanggal_nota') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select wire:model="status_nota" name="" id="">
                                            <option value="">pilih</option>
                                            <option value="1">setor barang</option>
                                            <option value="2">cacat/retur</option>
                                        </select>
                                    </div>
                                    @error('status_nota') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="inputName2" class="col-sm-2 col-form-label">Qty</label>
                                    <div class="col-sm-10">
                                        <input wire:model="qty_nota" type="text" class="form-control" id="inputName2">
                                        @error('qty_nota') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputExperience" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-10">
                                        <textarea wire:model="keterangan_nota" class="form-control" id="inputExperience"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" wire:model="ceksuratJalan"> Surat jalan supplier
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @if($ceksuratJalan === true)
                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Surat jalan supplier</label>
                                    <div class="col-sm-10">
                                        <input wire:model="sj_supp" type="text" class="form-control" id="inputSkills">
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button class="btn btn-danger" wire:click="simpanSetor">Simpan</button>
                                    </div>
                                </div>

                            </div>
                            <table class="table text-center">
                                <thead class="">
                                    <tr>
                                        <th>No Nota</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Qty</th>
                                        <th>Sj Supplier</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datanota as $data)
                                    <tr>
                                        <td>{{$data->nomor_surat_jalan}}</td>
                                        <td>{{$data->tanggal_surat_jalan}}</td>
                                        <td>
                                            @if($data->status_inout)
                                            Setor
                                            @else
                                            Cacat/Retur
                                            @endif
                                        </td>
                                        <td>{{$data->jumlah_produk}}</td>
                                        <td>
                                            @if($data->cek_sj_supp === null)
                                            belum
                                            @else
                                            ada
                                            @endif
                                        </td>
                                        <td>{{$data->keterangan_surat_jalan}}</td>
                                        <td>
                                            <x-jet-button>revisi</x-jet-button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @endif
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>





</div>