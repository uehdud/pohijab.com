<x-planet-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><b>PO HIJAB PLANET FASHION</b></div>
                    <div class="card-body">
                        <livewire:produksi.add-po />
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="mt-3">
                            <table data-toggle="table" data-search="true" data-show-columns="true" data-pagination="true" class="min-w-max w-full table-auto">
                                <thead style="font-size: 14px;">
                                    <th data-field="no">No</th>
                                    <th data-field="po">No PO</th>
                                    <th data-field="merk">Merk</th>
                                    <th data-field="supp">Supplier</th>
                                    <th data-field="status">Status</th>
                                    <th data-field="kb">KB</th>
                                    <th data-field="model">Model</th>
                                    <th data-field="bahan">Bahan</th>
                                    <th data-field="hargaplanet">Harga Planet</th>
                                    <th data-field="hargata">Harga TA</th>
                                    <th data-field="seri">Qty Seri</th>
                                    <th data-field="ket">Keterangan</th>
                                    <th data-field="tanggal">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach($datainout as $index => $item)
                                    <tr data-title="bootstrap table" data-object='{"key": "value"}'>
                                        <td style="font-size: 12px;">{{$no++}}</td>
                                        <td style="font-size: 12px;">{{$item->nomor_po}}</td>
                                        <td style="font-size: 12px;">{{$item->merk}}</td>
                                        <td style="font-size: 12px;">{{$item->kode_supp}}-{{$item->nama_supp}}</td>
                                        <td style="font-size: 8px;">{{$item->nama_status}}
                                            @if($item->statusFoto->status_id === 1)
                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-secondary opacity-50 text-white">
                                                Belum
                                            </p>
                                            @else
                                            @if($item->statusFoto->status_id === 3)
                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-success opacity-70 text-white">
                                                Selesai
                                            </p>
                                            @else
                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-warning opacity-70 text-white">
                                                Proses
                                            </p>
                                            @endif
                                            @endif
                                        </td>
                                        <td style="font-size: 12px;">{{$item->kb}}</td>
                                        <td style="font-size: 12px;">{{$item->kode_model}}</td>
                                        <td style="font-size: 12px;">{{$item->kode_bahan}}-{{$item->nama_bahan}}</td>
                                        <td style="font-size: 12px;">{{$item->harga_planet}}</td>
                                        <td style="font-size: 12px;">{{$item->harga_ta}}</td>
                                        <td style="font-size: 12px;">{{$item->qty_seri}}</td>
                                        <td style="font-size: 12px;">{{$item->keterangan_po}}</td>
                                        <td style="font-size: 12px;">
                                            <div class="flex item-center justify-center">
                                                <a href="{{ route('admin.users.update', $item->id) }}">
                                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg>
                                                    </div>
                                                </a>
                                                <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus data?')">
                                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </div>
                                                    </button>
                                                </form>
                                            </div>
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
    </div>





</x-planet-layout>