<div>
    <div>
        <div class="card">
            <div class="card-body">
                <!---List Foto Satuan-->
                <div class=" my-3">
                    <div class="">
                        <div class="row">
                            @foreach($foto_satuan as $fotos)
                            <div class="col-md-3 border mt-2">
                                <img src="{{ $fotos->imagevideo_detail }}" class="img-fluid rounded-start">
                                <div class="mt-2">
                                    <button class=" mb-2 btn-sm text-success float-sm-right" wire:click="downloadFotoSatuan({{$fotos->id}})">
                                        <i class="fa-solid fa-square-caret-down"></i>
                                        <a class="text-success" style="text-decoration: none; " class="pl-1 text-dark"> download</a>
                                    </button>
                                    <button class="mb-2 btn-sm text-danger float-sm-right" wire:click="hapusFotoSatuan({{$fotos->id}})">
                                        <i class="fa-solid fa-trash-can"></i>
                                        <a class="text-danger" style="text-decoration: none; " class="pl-1 text-dark"> hapus</a>
                                    </button>
                                </div>
                                <x-jet-button wire:loading wire:target="downloadFotoSatuan({{$fotos->id}})"><i class="fas fa-spinner fa-spin text-md"></i></x-jet-button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
    </div>
</div>