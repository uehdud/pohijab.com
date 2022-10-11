<x-foto-layout>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- <div class="mt-3">
        <form action="{{ route('admin.fotos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-3">
                    <x-jet-label>Kode Barang</x-jet-label>
                    <x-jet-input name="kode_barang" type="text" />
                </div>
                <div class="mt-3">
                    <x-jet-label>Video</x-jet-label>
                    <input name="image" type="file" />
                </div>
                <div class="mt-3">
                    <x-jet-button type="submit">Simpan</x-jet-button>
                    
                </div>
        </form>
    </div> -->


    <div class="card" style="box-shadow: none;">
        <div class="card-header">Add Foto PO Hijab</div>
        <div class="card-body">
            <livewire:foto.upload-foto />
        </div>
    </div>




    <livewire:foto.list-foto-po />





</x-foto-layout>