<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <div class="row">
        <div class="col">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Nomor SJ : </td>
                        <td>{{$no_sj}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal : </td>
                        <td>{{$detailsj->tanggal_surat_jalan}}</td>
                    </tr>
                    <tr>
                        <td>Tujuan : </td>
                        <td>{{$detailsj->gudangtujuan->nama_toko}}</td>
                    </tr>
                    <tr>
                        <td>Keterangan : </td>
                        <td>{{$detailsj->keterangan_surat_jalan}}</td>
                    </tr>
                    <tr>
                        <td>
                            @if($detailsj->gudangtujuan->nama_toko === 'Online')
                            <x-jet-button wire:click="terimaSuratJalan">Terima Surat Jalan</x-jet-button>
                            @else
                            <x-jet-button wire:click="terimaSuratJalanStudio">Terima Surat Jalan Foto</x-jet-button>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="col"></div>
    </div>


    <div class="mt-3">
        <table class="table text-center table-sm">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>KB</th>
                    <th>ART</th>
                    <th>QTY</th>
                    <th>STATUS</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                $i=1;
                @endphp
                @foreach($datasj as $data)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$data->kode_barang}}</td>
                    <td>{{$data->detailProduk->art ?? ''}}</td>
                    <td>{{$data->qty_produk}}</td>
                    <td>{{$data->statusKirim->nama_status}}</td>
                    <td>revisi</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>