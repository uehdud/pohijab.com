<x-planet-layout>
    @livewire('gudang.surat-jalan')

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.gudangs.store')}}" enctype="multipart/form-data" method="POST">

                @csrf
                <input type="file" name="import_file">
                <br>
                <button class="btn btn-primary mt-3" type="submit">Impor</button>
            </form>
        </div>
    </div>



</x-planet-layout>