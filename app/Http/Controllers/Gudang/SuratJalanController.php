<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use App\Models\ProdukInoutSj;
use Illuminate\Http\Request;

class SuratJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gudang.surat-jalan');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($no_surat_jalan)
    {
        // dd($no_surat_jalan);
        // dd($no_surat_jalan);
       // $no_surat = $no_surat_jalan;
        $detailsj = $no_surat_jalan;
       // dd($no_surat);
        return view('gudang.detail-sj', ['detailsj' => $detailsj]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($no_surat_jalan)
    {
        $nosj = $no_surat_jalan;
        $detailsj = ProdukInoutSj::where('no_sj', $no_surat_jalan)->get();
        // dd($detailsj);
        return view('gudang.edit-sj', ['detailsj' => $detailsj], ['nosj' => $nosj]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
