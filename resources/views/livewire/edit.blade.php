<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row mt-4">
                                <div class="col col-10">
                                    <label for="exampleFormControlInput1" class="form-label">Kode Barang</label>
                                    <input value="{{$detailproduks->kode_barang}}" wire:model="kode_barang" type="text" class="form-control" id="exampleFormControlInput1" placeholder="kb">
                                </div>
                                @if ($errors->has('kode_barang'))
                                <p style="color: red;">{{$errors->first('kode_barang')}}</p>
                                @endif
                            </div>
                            <div class="row mt-4">
                                <div class="col col-10">
                                    <label for="exampleFormControlInput1" class="form-label">Qty Terima</label>
                                    <input wire:model.defer="qty_terima" type="text" class="form-control" id="exampleFormControlInput1" placeholder="qty">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col col-10">
                                    <label for="exampleFormControlInput1" class="form-label">No Surat Jalan</label>
                                    <input wire:model.defer="no_surat_jalan" type="text" class="form-control" id="exampleFormControlInput1" placeholder="No SJ">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col col-10">
                                    <label for="exampleFormControlInput1" class="form-label">Keterangan</label>
                                    <input wire:model.defer="keterangan" type="text" class="form-control" id="exampleFormControlInput1" placeholder="keterangan">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row mt-4">
                                <div class="col-sm-10">
                                    <label for="exampleFormControlInput1" class="form-label">Foto Combo</label>
                                    <div class="flex items-center justify-center w-full">
                                        <label class="flex flex-col w-full h-32 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300">
                                            <div class="flex flex-col items-center justify-center pt-7">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400 group-hover:text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                                </svg>
                                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                                                    Pilih Foto</p>
                                            </div>
                                            <input type="file" class="opacity-0" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="mt-3">
                        <button x-on:click="on = false" type="button" class="btn btn-primary" wire:click.prevent="store">Simpan</button>
                    </div>

            </div>



        </div>

        </form>
    </div>
</div>
</div>