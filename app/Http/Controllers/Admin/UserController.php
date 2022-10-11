<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Datapo;
use App\Models\Produk;
use App\Models\ProdukProduksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

    public $status = 005216;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produkProduksi = ProdukProduksi::all()->sortDesc();

        return view('admin.index', ['datainout' => $produkProduksi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataInout = ProdukProduksi::find($id);
        //dd($dataInout);
        return view('edit-inout', ['datainouts' => $dataInout]);
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
    public function update(Request $request,  $id)
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
        return redirect()->route('admin.users.index')->with(['message' => 'Data Berhasil Diubah!']);
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

        return redirect()->route('admin.users.index')->with(['message' => 'Data Berhasil Dihapus!']);
    }
}
