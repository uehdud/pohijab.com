<div>

    <div class="card " style="box-shadow: none;">
        <div class="card-header">
            <div class="col-sm-4">
                <input wire:model="search" type="search" placeholder="Cari KB/Model..." class="block w-full pl-10 pr-3 py-2 border border-gray-300
            rounded-md leading-5 bg-white
            placeholder-gray-500
            focus:outline-none
            focus:placeholder-gray-400
            focus:border-blue-300
            focus:shadow-outline-blue
            sm:text-sm transition duration-150 ease-in-out">
            </div>
        </div>
        <div class="card-body">


            <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach($listfotopo as $item)
                <div class="col">
                    <div class="card" style="box-shadow: none;">
                        <img class="card-img-top" src={{ $item->image_comp }} alt="{{ $item->kode_barang }}">
                        <div class="card-body pt-3">
                            <ul class="list-group list-group-flush ">
                                <li class="list-group-item  pt-0">
                                    <div class="col ">
                                        <h6 class="card-title "><b>{{ $item->kode_barang }}</b></h6>
                                    </div>
                                    <div class="col ">
                                        <h6 class="card-title pt-0 float-right "><b>{{ $item->kode_model }}</b></h6>
                                    </div>
                                </li>
                                <li class="list-group-item py-0"></li>
                            </ul>
                            <div class="row">

                            </div>
                        </div>

                        <a style="text-decoration: none;" class="text-black" href="{{ route('foto.fotos.show', $item->kode_barang) }}">
                            <div class="card-footer text-center">
                                Detail
                            </div>
                        </a>


                    </div>
                </div>
                @endforeach

            </div>


        </div>

        <div class="card-footer">
            {{ $listfotopo->links() }}
        </div>
    </div>
</div>