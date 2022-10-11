<x-planet-layout>

    <div class="container mt-3">
        <div class="row justify-content-center">

            <div class="col-md-7">
                <div class="card">
                    <div class="card-header"><b>EDIT IN OUT FOTO PO {{$datainouts->nomor_po}} </b></div>
                    <div class="card-body ">
                        <form action="{{ route('admin.inout.update', $datainouts->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="px-5 row">
                                <div class="col-sm-6">
                                    <div class="mt-3">
                                        <x-jet-label>No PO</x-jet-label>
                                        <x-jet-input type="text" name="nomor_po" value="{{$datainouts->nomor_po}}" />
                                    </div>
                                    @if($errors->has('nomor_po'))
                                    <small class="error">{{ $errors->first('nomor_po') }}</small>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <div class="mt-3">
                                        <x-jet-label>KB</x-jet-label>
                                        <x-jet-input type="text" name="kode_barang" value="{{$datainouts->kode_barang}}" />
                                    </div>
                                    @if($errors->has('kode_barang'))
                                    <small class="error">{{ $errors->first('kode_barang') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="px-5 row">
                                <div class="col-sm-6">
                                    <div class="mt-3">
                                        <x-jet-label>Qty Seri</x-jet-label>
                                        <x-jet-input type="text" name="qty_seri" value="{{$datainouts->qty_seri}}" />
                                    </div>
                                    @if($errors->has('qty_seri'))
                                    <small class="error">{{ $errors->first('qty_seri') }}</small>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <div class="mt-3">
                                        <x-jet-label>Model</x-jet-label>
                                        <x-jet-input type="text" name="kode_model" value="{{$datainouts->kode_model}}" />
                                    </div>
                                    @if($errors->has('kode_model'))
                                    <small class="error">{{ $errors->first('kode_model') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="px-5 row">
                                <div class=" col-sm-6">
                                    <div class="mt-3">
                                        <x-jet-label>Kode Bahan</x-jet-label>
                                        <x-jet-input type="text" name="kode_bahan" value="{{$datainouts->kode_bahan}}" />
                                    </div>
                                    @if($errors->has('kode_bahan'))
                                    <small class="error">{{ $errors->first('kode_bahan') }}</small>
                                    @endif
                                </div>
                                <div class="mt-3 col-sm-6">
                                    <x-jet-label>Nama Bahan</x-jet-label>
                                    <x-jet-input type="text" name="nama_bahan" value="{{$datainouts->nama_bahan}}" />
                                </div>
                            </div>
                            <div class="px-5 row">
                                <div class="col-sm-6">
                                    <div class="mt-3">
                                        <x-jet-label>Harga Planet</x-jet-label>
                                        <x-jet-input type="text" name="harga_planet" value="{{$datainouts->harga_planet}}" />
                                    </div>
                                    @if($errors->has('harga_planet'))
                                    <small class="error">{{ $errors->first('harga_planet') }}</small>
                                    @endif
                                </div>
                                <div class="mt-3 col-sm-6">
                                    <x-jet-label>Harga TA</x-jet-label>
                                    <x-jet-input type="text" name="harga_ta" value="{{$datainouts->harga_ta}}" />
                                </div>
                                @if($errors->has('harga_ta'))
                                <small class="error">{{ $errors->first('harga_ta') }}</small>
                                @endif
                            </div>
                            <div class="px-5 row">
                                <div class="mt-3 col-sm-6">
                                    <x-jet-label>Keterangan</x-jet-label>
                                    <x-jet-input type="text" name="keterangan_po" value="{{$datainouts->keterangan_po}}" />
                                </div>

                                <div class="mt-5 col-sm-6">

                                </div>
                            </div>
                            <div class="px-5 row">
                                <div class="col-md-8"></div>
                                <div class="mt-3 items-end col-md-4">
                                    <x-jet-button type="submit">Simpan</x-jet-button>
                                </div>
                            </div>


                        </form>
                        <div class="mt-3 col-sm-8">
                            <a href="{{ route('admin.inout.index') }}" :active="request()->routeIs('inout.index.*')">
                                <x-jet-button>kembali</x-jet-button>
                            </a>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        List Status
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($datastatus as $index => $itemstatus)
                            <li class="list-group-item">
                                @if($itemstatus->stat->nama_status === 'Input in out')
                                <p class="text-secondary">
                                    {{$itemstatus->stat->nama_status}}-{{date('d F,Y',strtotime($itemstatus->updated_at))}} | <small>Gudang:{{$itemstatus->gudang->nama_gudang}}<i>-{{$itemstatus->user->name}}</i></small>
                                </p>
                                @else
                                @if($itemstatus->stat->nama_status === 'Selesai Foto')
                                <p class="text-success">
                                    {{$itemstatus->stat->nama_status}}-{{date('d F,Y',strtotime($itemstatus->updated_at))}} | <small>Gudang:{{$itemstatus->gudang->nama_gudang}}<i>-{{$itemstatus->user->name}}</i></small>
                                </p>
                                @else
                                <p class="text-warning">
                                    {{$itemstatus->stat->nama_status}}-{{date('d F,Y',strtotime($itemstatus->updated_at))}} | <small>Gudang:{{$itemstatus->gudang->nama_gudang}}<i>-{{$itemstatus->user->name}}</i></small>
                                </p>
                                @endif
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <div class="container">

    </div>
</x-planet-layout>