<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FotoVideoProduk;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $post = new FotoVideoProduk();
        $post->kode_barang = $request->kode_barang;
        $post->kode_model = $request->kode_model;
        $post->image_produk = $request->image_produk;
        $post->image_folder = $request->image_folder;
        $post->video_produk = $request->video_produk;
        $post->video_comp = $request->video_comp;
        $post->user_upload = $request->user_upload;
        $post->ekstensi_combo = $request->ekstensi_combo;
        $post->filesize_combo = $request->filesize_combo;
        $post->filesize_video = $request->filesize_video;
        $post->ekstensi_video = $request->ekstensi_video;
        $hasil =  $post->save();

        if ($hasil) {
            return ["Result" => "Data berhasil disimpan"];
        }
        else{
            return ["Result" => "Data gagal disimpan"];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
