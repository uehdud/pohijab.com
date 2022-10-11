<div>
    <div class="card" style="box-shadow: none;">
        <div class="card-header ">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
            List Surat jalan Keluar
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Sj</th>
                        <th>Tanggal</th>
                        <th>Gudang Tujuan</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i=1;
                    @endphp
                    @foreach($listsj as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{$item->nomor_surat_jalan}}</td>
                        <td>{{$item->tanggal_surat_jalan}}</td>
                        <td>{{$item->toko->nama_toko}}</td>
                        <td>{{$item->keterangan_surat_jalan}}</td>
                        <td class="text-success text-bold "><i>{{$item->statusSJ->nama_status}}</i></td>
                        <td>
                            <a target="blank" href="{{ route('gudang.suratjalan.show', $item->nomor_surat_jalan) }}" class="text-sm text-dark px-1" style="text-decoration: none;"><i class="fa-solid fa-print"></i></a>
                            @can('manage-admingudang')
                            <a href="{{ route('gudang.suratjalan.edit',$item->nomor_surat_jalan) }}" class=" text-sm text-dark px-1" style="text-decoration: none;"> <i class="fa-solid fa-pen"></i></a>
                            @endif
                            <!-- /*   <button class="text-danger" wire:click="cancelSuratJalan({{$item->id}})"> cancel</a>
                                */ -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card card-secondary" style="box-shadow: none;">
        <div class="card-header ">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
            List Surat Jalan Masuk
        </div>
        <div class="card-body">
            <table class="table table-sm text-sm t">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Sj</th>
                        <th>Tanggal</th>
                        <th>Gudang Tujuan</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i=1;
                    @endphp
                    @foreach($listsjmasuk as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{$item->nomor_surat_jalan}}</td>
                        <td>{{$item->tanggal_surat_jalan}}</td>
                        <td>{{$item->toko->nama_toko}}</td>
                        <td>{{$item->keterangan_surat_jalan}}</td>
                        <td class="text-bold">
                            @if($item->statusSJ->nama_status === 'Terkirim')


                            <i><span class="text-danger">Belum Diterima</span></i>
                            @else

                            {{$item->statusSJ->nama_status}}
                            @endif
                        </td>
                        <td>
                            <a target="blank" href="{{ route('gudang.suratjalan.show', $item->nomor_surat_jalan) }}" class="text-sm text-dark px-1" style="text-decoration: none;"><i class="fa-solid fa-print"></i></a>
                            @can('manage-admingudang')
                            <a href="{{ route('gudang.suratjalan.edit',$item->nomor_surat_jalan) }}" class=" text-sm text-dark px-1" style="text-decoration: none;" target="_blank">detail</a>
                            @endif
                            <!-- /*   <button class="text-danger" wire:click="cancelSuratJalan({{$item->id}})"> cancel</a>
                                */ -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>