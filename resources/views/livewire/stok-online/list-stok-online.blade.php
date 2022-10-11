<div>
    <div class="card mt-3 card-outline card-info">
        <div class="card-header">
            List Stok Online

            <input type="search" class="float-right" wire:model="search">
        </div>
        <div class="card-header">
            <span class="text-center"><strong>Jumlah Stok Online : {{ $jumlahstok }}</strong></span>
        </div>
        <div class="card-body">
            <table class="table text-center table-sm text-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Lokasi</th>
                        <th>Kode Barang</th>
                        <th>Warna</th>
                        <th>Ukuran</th>
                        <th>Stok</th>
                        @can('manage-online')
                        <th>Status</th>
                        <th></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i=1;
                    @endphp
                    @foreach($liststok as $index => $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$item->lokasi}}</td>
                        <td>{{$item->kode_barang}}</td>
                        <td>{{$item->warna->nama_warna}}</td>
                        <td>{{$item->ukuran->nama_ukuran}}</td>
                        <td>{{$item->jumlah_stok_online}}</td>
                        @can('manage-online')
                        <td>@livewire('stok-online.status-stok',['id'=>$item->id, key($item->id.$index)] )</td>

                        <td><a href="{{route('online.editproduk.show',$item->id) }}" target="_blank">edit</a></td>
                        @endif
                    </tr>

                    @endforeach
                </tbody>
            </table>
            {{ $liststok->links() }}
        </div>

    </div>
</div>