<div>
    <label>Kode Barang/label>
        <input wire:model="kode_barang" type="text" class="form-control" />
        @if ($errors->has('kode_barang'))
        <p style="color: red;">{{$errors->first('kode_barang')}}</p>
        @endif
        <label>Qty Seri</label>
        <textarea wire:model="qty_seri" type="text" class="form-control" /></textarea>
        @if ($errors->has('qty_seri'))
        <p style="color: red;">{{$errors->first('qty_seri')}}</p>
        @endif
        <br />
        <button wire:click="save" class="btn btn-primary">Simpan</button>
</div>