<x-app-layout>
    <div class="container">
        <table class="table bordered">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Qyt</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection as $item)
                <tr>
                    <td>{{$item->alias}}</td>
                    <td>{{$item->qyt}}</td>
                    <td>{{$item->stok}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>






    </div>
</x-app-layout>