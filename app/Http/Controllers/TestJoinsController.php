<?php

namespace App\Http\Controllers;

use App\Models\TestJoin;
use App\Http\Requests\StoreTestJoinRequest;
use App\Http\Requests\UpdateTestJoinRequest;
use App\Models\Stokout;

class TestJoinsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Stokout::find(1);
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
     * @param  \App\Http\Requests\StoreTestJoinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestJoinRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TestJoin  $testJoin
     * @return \Illuminate\Http\Response
     */
    public function show(TestJoin $testJoin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TestJoin  $testJoin
     * @return \Illuminate\Http\Response
     */
    public function edit(TestJoin $testJoin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTestJoinRequest  $request
     * @param  \App\Models\TestJoin  $testJoin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestJoinRequest $request, TestJoin $testJoin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TestJoin  $testJoin
     * @return \Illuminate\Http\Response
     */
    public function destroy(TestJoin $testJoin)
    {
        //
    }
}
