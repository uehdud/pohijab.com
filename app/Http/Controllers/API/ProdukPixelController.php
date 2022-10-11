<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProdukProduksi;
use App\Models\ResumeStokOnline;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class ProdukPixelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ResumeStokOnline::with('detail.kategori', 'warna', 'ukuran', 'foto', 'fotosatuan', 'detailukuran')
            ->where('kode_merk', 'X')
            ->orderBy('created_at')
            ->get();
        return response()->json($data, Response::HTTP_OK);
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
    public function show($id)
    {
        $data = ResumeStokOnline::with('detail.kategori', 'warna', 'ukuran', 'foto', 'fotosatuan', 'detailukuran')
            ->where('kode_barang', $id)
            ->get();
        return response()->json($data, Response::HTTP_OK);
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
