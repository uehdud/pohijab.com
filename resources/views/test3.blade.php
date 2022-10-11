<x-app-layout>
    <div class="container">
        <table class="table bordered">
            <thead>
                <tr>
                    <th>NO PO</th>
                    <th>Merk</th>
                    <th>Model</th>
                    <th>Kode Bahan</th>
                    <th>Warna</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection as $item)
                <tr>
                    <td>{{$item->po}}</td>
                    <td>{{$item->merk}}</td>
                    <td>{{$item->model}}</td>
                    <td>{{$item->sku}}</td>
                    <td>{{$item->varian}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>






    </div>
</x-app-layout>