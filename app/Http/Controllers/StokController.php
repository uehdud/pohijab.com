<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PembagianStokPusat;
use App\Models\ProdukProduksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produkProduksi = ProdukProduksi::all()->sortDesc();

        return view('admin.stok', ['datainout' => $produkProduksi]);
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
        $nopo = $request->no_po;
        $jumlahstok = $request->jumlah_stok;

        foreach ($request->tokos as $toko) {
            $namatoko = $toko['toko_id'];
            $jumlah = $toko['quantity'];
            $sisa = $jumlahstok - $jumlah;
            if (PembagianStokPusat::where('no_po', '=', $nopo)->exists()) {
                $sisastok = DB::table('pembagian_stok_pusats')
                    ->latest('created_at')
                    ->select('sisa_stok_po')
                    ->first();

                $order = PembagianStokPusat::create([
                    'no_po' => $nopo,
                    'jumlah_stok_pembagian' => $jumlah,
                    'sisa_stok_po' =>  $sisastok->sisa_stok_po - $jumlah,
                    'toko_id' => $namatoko
                ]);
                return 'po sudah berhasil di update';
            } else {
                $order = PembagianStokPusat::create([
                    'no_po' => $nopo,
                    'jumlah_stok_pembagian' => $jumlah,
                    'sisa_stok_po' => $sisa,
                    'toko_id' => $namatoko
                ]);
                return 'Order stored successfully!';
            }
        }

        // dd($jumlah, $namatoko, $nopo, $jumlahstok);
        /* $order = PembagianStokPusat::create([
            'no_po' => $request->no_po,
        ]);

        foreach ($request->orderProducts as $product) {
            $order->products()->attach($product['product_id'],
                ['quantity' => $product['quantity']]);
        } */

        return 'Order stored successfully!';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('admin.detailstok');
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
