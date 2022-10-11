<div>


    <div class="card card-success" style="box-shadow: none;">
        <div class="card-header">
            Surat Jalan Gudang Pusat (GSP)
        </div>
        <div class="card-body">
            @if (session()->has('pesan'))
            <div class="alert alert-success">
                {{ session('pesan') }}
            </div>
            @endif
            <div class="m-3">
                <div class="row">
                    <div class="col-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>No Surat Jalan </td>
                                    <td>: {{ $nosj }} </td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>:
                                        <x-jet-input input wire:model.defer="tanggal_surat_jalan" type="date" />
                                        @error('tanggal_surat_jalan') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                                    </td>

                                </tr>
                                <tr>
                                    <td>Tujuan</td>
                                    <td>: <select wire:model="gudang_tujuan" name="" id="">
                                            <option value="">pilih</option>
                                            <option value="11">Foto</option>
                                            <option value="2">Online</option>
                                            <option value="7">Dewi Sartika</option>
                                        </select>
                                        @error('gudang_tujuan') <span class="text-sm text-danger">{{ $message }}</span> @enderror</td>

                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:
                                        <x-jet-input wire:model="keterangan_sj" type="text" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-8"></div>
                </div>
                <table class="table text-center text-sm">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Label</th>
                            <th>KB</th>
                            <th>KON</th>
                            <th>ART</th>
                            <th>KGR</th>
                            <th>MODAL</th>
                            <th>QTY</th>
                            <th>
                                @if($countcart > 0)
                                <button class="btn btn-sm btn-danger" wire:click="batalCart">batal</button>
                                @endif
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($carts as $cart)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$cart->gudang_penerima}}</td>
                            <td>{{$cart->kode_barang}}</td>
                            <td>{{$cart->detail->kode_supp ?? 'data belum tersedia'}}</td>
                            <td>{{$cart->detail->id_kategori ?? 'silahkan'}}.{{$cart->detail->kode_model ?? ''}}.{{$cart->detail->kode_bahan ?? ''}}.{{$cart->detail->kode_merk ?? ''}}</td>
                            <td>{{$cart->detail->kategori->nama_kategori ?? 'upload'}}</td>
                            <td>{{$cart->detail->kode_harga_modal ?? 'terlebih dahulu'}}</td>
                            <td>{{$cart->quantity}}</td>
                            <td><button class="text-danger" wire:click="delete({{$cart->id}})">batal</button></td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="6"></td>
                            <td>Jumlah</td>
                            <td>{{$jumlah}}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="row mt-3">
                    <div class="col float-right">
                        <x-jet-button wire:click="buatSJ">Kirim</x-jet-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>