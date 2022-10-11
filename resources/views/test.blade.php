<x-app-layout>



    <div class="container">
        <form action="/inputproduk" method="POST">


            <select name="" id="">
                <option value="">pilih</option>
                @foreach($produk as $item)
                <option value="$item['poID']">{{ $item['po'] }}</option>
                <input type="text" value="{{ $item['kode'] }}">
                @endforeach
            </select>
            <button class="btn btn-sm btn-primary mt-3" type="submit">Submit</button>
        </form>

    </div>
</x-app-layout>