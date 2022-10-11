<x-foto-layout>
    @livewire('foto.detail',['kb'=>$datafoto->kode_barang])
    @livewire('foto.list-foto-satuan',['kb'=>$datafoto->kode_barang])

</x-foto-layout>