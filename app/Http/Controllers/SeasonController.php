<?php

namespace Growth\Http\Controllers;

use Auth;
use Growth\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seasons = Season::where('user_id', Auth::user()->id)->get();
        return view('season.season', compact('seasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('season.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Season
     */
    public function store(Request $request)
    {
        $season = new Season();
        $season->fill($request->all());
        $season->active = Season::ACTIVE;
        if (!$request->input('unlimited')){
            $season->unlimited = Season::NOT_ACTIVE;
        }
        $season->save();
        return $season;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Growth\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function show(Season $season)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Growth\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seasons = Season::find($id);
        return view('season.update', compact('seasons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Growth\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Season $season)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Growth\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function destroy(Season $season)
    {
        //
    }
}
