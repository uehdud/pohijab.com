<div>
    <div class="row mx-3 bg-gray-100">
        <div class="col text-center border-1 py-2"><b>KB</b> </div>
        <div class="col text-center border-1 py-2"><b>S</b></div>
        <div class="col text-center border-1 py-2"><b>M</b></div>
        <div class="col text-center border-1 py-2"><b>L</b></div>
        <div class="col text-center border-1 py-2"><b>XL</b></div>
        <div class="col text-center border-1 py-2"><b>XXL</b></div>
    </div>


    @foreach($datagudangpusat as $index => $item)

    @livewire('tabel.data-list',['kb'=>$item->kode_barang])

    @endforeach

    {{ $datagudangpusat->links() }}




</div>