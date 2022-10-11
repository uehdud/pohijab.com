<?php

namespace App\Http\Controllers\Foto;

use App\Http\Controllers\Controller;
use App\Models\FotoVideoProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('foto.index');
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
        //dd($request->image);
        $this->validate($request, ['image' => 'required|image']);
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $name = time() . $file->getClientOriginalName();
            $filePath = $request->kode_barang . '/' . $name;
            $path = Storage::disk('s3')->url($filePath);
            Storage::disk('s3')->put($filePath, fopen($file, 'r+'));
            $post = FotoVideoProduk::create([
                'kode_barang' => $request->kode_barang,
                'image_produk' => $path,

            ]);
            return back()->with('success', 'Image Uploaded successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kode_barang)
    {
        $datafoto = FotoVideoProduk::where('kode_barang', $kode_barang)->first();
        // dd($datafoto);
        return view('foto.show-detail', compact('datafoto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode_barang)
    {

        $datafoto = FotoVideoProduk::where('kode_barang', $kode_barang)->first();
        return view('foto.detail', compact('datafoto'));
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
