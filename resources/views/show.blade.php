<x-app-layout>



    <div class="container">
        <p>{{$id}}</p>
        @foreach($collections as $item)
        <p>{{$item['merk']}}</p>
        @endforeach
    </div>
</x-app-layout>