<?php

namespace App\Http\Controllers\Admin;

use App\Exports\InoutExport;
use App\Http\Controllers\Controller;
use App\Imports\InoutImport;
use App\Imports\TransaksiImport;
use App\Models\FotoVideoProduk;
use App\Models\MstStatus;
use App\Models\ProdukProduksi;
use App\Models\Statusproduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class InoutController extends Controller
{
    use WithPagination;
    public $kodea = 452925;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $produkProduksi = MstStatus::all()->sortDesc();
        foreach ($produkProduksi as $item) {
            $data = $item['kode_barang'];
        }

        dd($data); */
        $produkProduksi = DB::table('resume_statuses')
            ->rightJoin('produk_produksis', 'resume_statuses.kode_barang', '=', 'produk_produksis.kode_barang')
            ->leftjoin('mst_statuses', 'status_id', '=', 'mst_statuses.id')
            ->leftjoin('mst_gudangs', 'gudang_id', '=', 'mst_gudangs.id')
            ->select(
                'produk_produksis.id',
                'nomor_po',
                'nama_status',
                'nama_gudang',
                'produk_produksis.kode_barang',
                'kode_model',
                'kode_bahan',
                'nama_bahan',
                'harga_ta',
                'harga_planet',
                'qty_seri',
                'keterangan_po',
                'merk'
            )->orderBy('produk_produksis.kode_barang', 'desc')
            ->paginate(10);
        //dd($produkProduksi);
        return view('admin.inout');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Excel::download(new InoutExport, 'inout.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Excel::import(new InoutImport(), $request->file('import_file', null,  \Maatwebsite\Excel\Excel::CSV));
        return redirect()->route('admin.inout.index')->with(['message' => 'Data Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nomor_po)
    {

        $datab = DB::table('produk_produksis')
            ->where('nomor_po', '=', $nomor_po)->select('kode_barang')
            ->get();
        //dd($datab);
        $object = new stdClass();
        foreach ($datab as $key => $value) {
            $object->$key = $value;
        }

        $kodeb = $value->kode_barang;
        $kodea = (int)$kodeb;

        $datastatus = Statusproduk::where('kode_barang', '=', $kodea)
            ->get();

        $dataInout = ProdukProduksi::where('nomor_po', $nomor_po)->first();
        // dd($kodea);
        return view('edit-inout', ['datainouts' => $dataInout], ['datastatus' => $datastatus]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_po' => 'required|numeric',
            'kode_barang' => 'required|numeric',
            'qty_seri' => 'required|numeric',
            'kode_model' => 'required',
            'kode_supp' => 'required',
            'nama_supp' => 'required',
            'kode_bahan' => 'required',
            'nama_bahan' => 'required',
            'harga_planet' => 'required',
            'harga_ta' => 'required'
        ]);

        $dataInout = ProdukProduksi::find($id);
        $dataInout->update($request->all());
        $dataInout->save();
        return redirect()->route('admin.inout.index')->with(['message' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProdukProduksi::destroy($id);

        return redirect()->route('admin.inout.index')->with(['message' => 'Data Berhasil Dihapus!']);
    }

    public function export()
    {
    }
}
