<x-planet-layout>
    <div class="card mt-3">
        <div class="card-header">
            Export & Import Data In Out
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <form action="{{route('admin.inout.create')}}" enctype="multipart/form-data" method="GET">
                        <x-jet-button type="submit">Export</x-jet-button>
                    </form>
                </div>
                <div class="col">
                    <livewire:download-template />
                </div>
                <div class="col">
                    <form action="{{route('admin.inout.store')}}" enctype="multipart/form-data" method="POST">

                        @csrf
                        <input type="file" name="import_file">
                        <br>
                        <x-jet-button class="mt-3" type="submit">Import</x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <livewire:detailproduk />

</x-planet-layout>