<div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-center">No</th>
                        <th class="py-3 px-6 text-center">Kode Barang</th>
                        <th class="py-3 px-6 text-center">Stok</th>
                        <th class="py-3 px-6 text-center">Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i=1;
                    @endphp
                    @foreach($stokonline as $index => $stok)
                    <tr>
                        <td class="py-3 px-6 text-center">
                            {{ $i++ }}
                        </td>
                        <td class="py-3 px-6 text-center">
                            {{ $stok->kode_barang }}
                        </td>
                        <td class="py-3 px-6 text-center">
                            {{ $stok->jumlah_stok_online }}
                        </td>
                        <td class="py-3 px-6 text-center">

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $stokonline->links() }}
        </div>
    </div>
</div>