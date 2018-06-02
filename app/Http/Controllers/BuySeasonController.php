<?php

namespace Growth\Http\Controllers;

use Growth\Buy_season;
use Growth\Client;
use Growth\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuySeasonController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user()->id;
        $seasons = Season::where('user_id', $user)->get();
        $clients = Client::where('user_id', $user)->get();
        return view('season.buyCreate', compact('seasons', 'clients'));
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
     * @param  \Growth\Buy_season  $buy_season
     * @return \Illuminate\Http\Response
     */
    public function show(Buy_season $buy_season)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Growth\Buy_season  $buy_season
     * @return \Illuminate\Http\Response
     */
    public function edit(Buy_season $buy_season)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Growth\Buy_season  $buy_season
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buy_season $buy_season)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Growth\Buy_season  $buy_season
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buy_season $buy_season)
    {
        //
    }
}
