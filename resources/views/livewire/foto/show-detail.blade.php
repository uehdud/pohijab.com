<div>
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ $datafoto->image_comp }}" class="img-fluid rounded-start" alt="{{ $datafoto->kode_barang }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>{{ $datafoto->kode_barang }}</strong>
                        </li>

                    </ul>



                    <!--  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                </div>

            </div>
        </div>
        <div class="card-footer">
            <x-jet-button wire:click="downloadFoto"><i class="fa-solid fa-square-caret-down"></i><a style="text-decoration: none; " class="pl-1 text-white"> download foto combo</a></x-jet-button>
            <p class="card-text float-right"><small class="text-muted">{{ date('j F, Y, g:i A', strtotime($datafoto->updated_at))  }} - Oleh {{ $datafoto->userUpload->name }} </small></p>
        </div>
    </div>

    <div class=" my-3">
        <div class="">
            <div class="row">
                @foreach($foto_satuan as $fotos)
                <div class="col-md-3 border mt-2">
                    <img src="{{ $fotos->imagevideo_detail }}" class="img-fluid rounded-start" alt="{{ $datafoto->kode_barang }}">
                    <button class="btn mb-2 btn-sm btn-outline-secondary float-sm-right" wire:click="downloadFotoSatuan({{$fotos->id}})"><i class="fa-solid fa-square-caret-down"></i><a style="text-decoration: none; " class="pl-1 text-dark"> download</a></button>
                    <x-jet-button wire:loading wire:target="downloadFotoSatuan({{$fotos->id}})"><i class="fas fa-spinner fa-spin text-md"></i></x-jet-button>
                </div>
                @endforeach


            </div>

        </div>

    </div>

    <div class="card">
        <div class="card-body">
            <div class="mt-3">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Nama file</th>
                            <th>Ukuran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $datafotos->kode_barang }}</td>
                            <td>
                                {{ $size_video }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                <x-jet-button wire:click="downloadVideo"><i class="fa-solid fa-square-caret-down"></i><a style="text-decoration: none; " class="pl-1 text-white"> download video</a></x-jet-button>
            
                <x-jet-button wire:loading wire:target="downloadVideo"><i class="fas fa-spinner fa-spin text-md"></i></x-jet-button>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body"></div>
    </div>



</div>