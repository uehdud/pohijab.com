<div>
    <div class="card card-info">
        <div class="card-header">
            List Surat Jalan Masuk Online dan Foto
        </div>
        <div class="card-body">
            <table class="table text-center table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Sj</th>
                        <th>Tanggal</th>
                        <th>Tujuan</th>
                        <th>Qty</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i=1;
                    @endphp
                    @foreach($listsj as $data)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$data->nomor_surat_jalan}}</td>
                        <td>{{$data->tanggal_surat_jalan}}</td>
                        <td>{{$data->gudangtujuan->nama_toko}}</td>
                        <td>{{$data->jumlah_produk}}</td>
                        <td>{{$data->keterangan_surat_jalan}}</td>
                        <td>{{$data->statusSJ->nama_status}}</td>
                        <td>
                            <a href="{{ route('online.terimasj.show',$data->nomor_surat_jalan) }}" class=" text-sm text-danger px-1" style="text-decoration: none;" target="_blank"><i class="fa-solid fa-pen"></i> detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $listsj->links()}}
        </div>
    </div>
</div>