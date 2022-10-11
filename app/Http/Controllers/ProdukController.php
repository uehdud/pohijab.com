<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Produk;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produks = null;
        $response = Http::get('https://bahanapi.pohijab.com/api/bahan/005177');
        if ($response->successful()) {
            $produks = json_decode($response, true);
            $produks = $produks['data'];
        }

        return view('test', ['produk' => $produks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Http::get('https://api.pohijab.com/public/api/stock')->json();
        //dd($collection);
        Produk::create([
            'product_id' => $data['produk_id'],
            'bahan' => $data['bahan']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $collection = DB::table('stock_out')
            ->join('stock_out_detail', 'stock_out.kode', "=", 'stock_out_detail.kode')
            ->join('mst_produk', 'stock_out_detail.produk_id', "=", 'mst_produk.id')
            ->where('stock_out.poID', $id)
            ->limit(1)
            ->select('*')
            ->get();

        return response()->json($collection, Response::HTTP_OK);
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
